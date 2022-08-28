<?php

namespace App\Modules\Stock\StorageLocation\Repository\Eloquent;

use App\Modules\Stock\StorageLocation\Domain\Entity\StorageLocationEntity;
use App\Modules\Stock\StorageLocation\Repository\StorageLocationRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class StorageLocationRepositoryEloquent extends BaseRepositoryEloquent implements StorageLocationRepositoryInterface
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
        $entityLoaded = StorageLocationEntity::fromArray($dataToLoadEntity);
        
        return $entityLoaded;
    }    
}