<?php

namespace App\Modules\Stock\Category\Repository\Eloquent;

use App\Modules\Stock\Category\Domain\Entity\CategoryEntity;
use App\Modules\Stock\Category\Repository\CategoryRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class CategoryRepositoryEloquent extends BaseRepositoryEloquent implements CategoryRepositoryInterface
{
    protected bool $inTransaction = false;    
    public function __construct(private Model $model){
        parent::__construct($model);
    }  
    
    /**
     * Converter Model para Entity
     *
     * @param Model $model
     * @return BaseEntity
     */
    protected function modelToEntity(Model $model): BaseEntity {
        $dataToLoadEntity = $model->toArray();
        $entityLoaded = CategoryEntity::fromArray($dataToLoadEntity);
        
        return $entityLoaded;
    }    
}