<?php

namespace App\Modules\Stock\Unit\Repository\Eloquent;

use App\Modules\Stock\Unit\Domain\Entity\UnitEntity;
use App\Modules\Stock\Unit\Repository\UnitRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class UnitRepositoryEloquent extends BaseRepositoryEloquent implements UnitRepositoryInterface
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
        $entityLoaded = UnitEntity::fromArray($dataToLoadEntity);
        
        return $entityLoaded;
    }    
}