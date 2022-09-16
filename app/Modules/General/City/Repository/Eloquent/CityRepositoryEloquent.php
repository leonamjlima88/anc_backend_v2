<?php

namespace App\Modules\General\City\Repository\Eloquent;

use App\Modules\General\City\Domain\Entity\CityEntity;
use App\Modules\General\City\Repository\CityRepositoryInterface;
use App\Modules\General\State\Domain\Entity\StateEntity;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\QueryEloquent;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Exception;
use Illuminate\Database\Eloquent\Model;

class CityRepositoryEloquent extends BaseRepositoryEloquent implements CityRepositoryInterface
{
    public bool $inTransaction = false;
    public function __construct(private Model $model){
        parent::__construct($model);
    }  
    
    public function store(BaseEntity $entity): string|int {
        throw new Exception("This method has not been implemented!");
    }

    public function update(BaseEntity $entity, string|int $id): bool {
        throw new Exception("This method has not been implemented!");
    }

    public function destroy(string|int $id): bool {
        throw new Exception("This method has not been implemented!");
    }

    protected function findById(string|int $id): ?Model
    {
        return $this->model
            ->where('city.id', $id)
            ->with('state')
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
            ->join('state', 'state.id', 'city.state_id')
            ->select(
                'city.*',
                'state.abbreviation as state_abbreviation'
            )
            ->orderBy('city.id');

        return QueryEloquent::make($pageFilterEntity, $queryBuilder)->execute();
    }

    /**
     * Converter Model para Entity
     *
     * @param Model $model
     * @return CityEntity
     */
    protected function modelToEntity(Model $model): CityEntity {
        // Converter Model em Array
        $dataToLoadEntity = $model->toArray();

        // StateEntity e CityEntity
        $dataToLoadEntity['state'] = new StateEntity(...$dataToLoadEntity['state']);
        $entityLoaded = CityEntity::fromArray($dataToLoadEntity);

        return $entityLoaded;
    }
}
