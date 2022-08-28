<?php

namespace App\Modules\Stock\Brand\Repository\Eloquent;

use App\Modules\Stock\Brand\Domain\Entity\BrandEntity;
use App\Modules\Stock\Brand\Repository\BrandRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class BrandRepositoryEloquent extends BaseRepositoryEloquent implements BrandRepositoryInterface
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
        $entityLoaded = BrandEntity::fromArray($dataToLoadEntity);
        
        return $entityLoaded;
    }    
}