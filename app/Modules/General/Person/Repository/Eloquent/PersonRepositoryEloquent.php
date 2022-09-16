<?php

namespace App\Modules\General\Person\Repository\Eloquent;

use App\Modules\General\City\Domain\Entity\CityEntity;
use App\Modules\General\Person\Domain\Entity\PersonAddressEntity;
use App\Modules\General\Person\Domain\Entity\PersonContactEntity;
use App\Modules\General\Person\Domain\Entity\PersonEntity;
use App\Modules\General\Person\Repository\PersonRepositoryInterface;
use App\Modules\General\State\Domain\Entity\StateEntity;
use App\Shared\Entity\BaseEntity;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\Eloquent\QueryEloquent;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonRepositoryEloquent extends BaseRepositoryEloquent implements PersonRepositoryInterface
{
    public bool $inTransaction = true;
    public function __construct(private Model $model){
        parent::__construct($model);
    }  
    
    public function store(BaseEntity $entity): BaseEntity {
        // Método anônimo para incluir
        $dataToStore = $entity->toArray();
        $executeStore = function ($dataToStore) {
            $modelStored = $this->model->create($dataToStore);
            
            $modelStored->personAddress()->createMany($dataToStore['person_address']);
            $modelStored->personContact()->createMany($dataToStore['person_contact']);

            return $this->show($modelStored->id);
        };

        // Controle de Transação
        $entityStored = match ($this->inTransaction) {
            true => DB::transaction(fn () => $executeStore($dataToStore)),
            false => $executeStore($dataToStore),
        };

        return $entityStored;
    }

    public function update(BaseEntity $entity, string|int $id): BaseEntity
    {
        // Localizar Model
        $modelFound = $this->findById($id);
        throw_if(!$modelFound, new ModelNotFoundException(trans('message_lang.model_not_found') . ' Id: ' . $id));

        // Método anônimo para atualizar
        $dataToUpdate = $entity->toArray();
        $executeUpdate = function ($dataToUpdate) use ($modelFound) {
            // Atualizar Person
            tap($modelFound)->update($dataToUpdate);
        
            // Atualizar PersonAddress
            $modelFound->personAddress()->delete();
            $modelFound->personAddress()->createMany($dataToUpdate['person_address']);

            // Atualizar PersonContact
            $modelFound->personContact()->delete();
            $modelFound->personContact()->createMany($dataToUpdate['person_contact']);
        
            return $this->show($modelFound->id);
        };

        // Controle de Transação
        $entityUpdated = match ($this->inTransaction) {
            true => DB::transaction(fn () => $executeUpdate($dataToUpdate)),
            false => $executeUpdate($dataToUpdate),
        };

        return $entityUpdated;
    }

    protected function findById(string|int $id): ?Model
    {
        return $this->model
            ->where('person.id', $id)
            ->with(
                'city.state',
                'personAddress.city.state',
                'personContact'
            )
            ->first();
    }

    /**
     * Filtragem de dados
     *
     * @param PageFilterEntity $pageFilterEntity
     * @return array
     */
    public function query(PageFilterEntity $pageFilterEntity): array
    {
        // QueryBuilder Base
        $queryBuilder = $this->model
            ->query()
            ->join('city', 'city.id', 'person.city_id')
            ->join('state', 'state.id', 'city.state_id')
            ->select(
                'person.*',
                'city.name as city_name',
                'state.abbreviation as state_abbreviation',
            )
            ->orderBy('person.id');            

        return QueryEloquent::make($pageFilterEntity, $queryBuilder)->execute();
    }

    /**
     * Converter Model para Entity
     *
     * @param Model $model
     * @return BaseEntity
     */
    protected function modelToEntity(Model $model): BaseEntity {
        // Converter Model em Array
        $dataToLoadEntity = $model->toArray();

        // StateEntity e CityEntity
        $dataToLoadEntity['city']['state'] = new StateEntity(...$dataToLoadEntity['city']['state']);
        $dataToLoadEntity['city']          = new CityEntity(...$dataToLoadEntity['city']);

        // PersonAddressEntity (StateEntity, CityEntity)
        $dataToLoadEntity['person_address'] = array_map(function ($item) {
            $item['city']['state'] = new StateEntity(...$item['city']['state']);
            $item['city']          = new CityEntity(...$item['city']);
            return new PersonAddressEntity(...$item);
        }, $dataToLoadEntity['person_address'] ?? []);

        // PersonContactEntity
        $dataToLoadEntity['person_contact'] = array_map(fn ($item) => new PersonContactEntity(...$item), $dataToLoadEntity['person_contact'] ?? []);

        $entityLoaded = PersonEntity::fromArray($dataToLoadEntity);
        return $entityLoaded;
    }
}
