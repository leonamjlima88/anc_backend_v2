<?php

namespace App\Modules\General\State\Repository\Eloquent;

use App\Modules\General\State\Domain\Entity\StateEntity;
use App\Modules\General\State\Repository\StateRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\QueryEloquent;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Exception;
use Illuminate\Database\Eloquent\Model;

class StateRepositoryEloquent extends BaseRepositoryEloquent implements StateRepositoryInterface
{
    public bool $inTransaction = false;
    public function __construct(private Model $model){
        parent::__construct($model);
    }  
    
    public function store(BaseEntity $entity): BaseEntity {
        throw new Exception("This method has not been implemented!");
    }

    public function update(BaseEntity $entity, string|int $id): BaseEntity {
        throw new Exception("This method has not been implemented!");
    }

    public function destroy(string|int $id): bool {
        throw new Exception("This method has not been implemented!");
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
            ->select('state.*')
            ->orderBy('state.id');

        return QueryEloquent::make($pageFilterEntity, $queryBuilder)->execute();
    }

    /**
     * Converter Model para Entity
     *
     * @param Model $model
     * @return PersonEntity
     */
    protected function modelToEntity(Model $model): StateEntity {
        // Converter Model em Array
        $dataToLoadEntity = $model->toArray();

        // StateEntity
        $entityLoaded = StateEntity::fromArray($dataToLoadEntity);

        return $entityLoaded;
    }
}
