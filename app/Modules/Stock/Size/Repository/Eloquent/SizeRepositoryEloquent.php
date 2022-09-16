<?php

namespace App\Modules\Stock\Size\Repository\Eloquent;

use App\Modules\Stock\Size\Domain\Entity\SizeEntity;
use App\Modules\Stock\Size\Repository\SizeRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class SizeRepositoryEloquent extends BaseRepositoryEloquent implements SizeRepositoryInterface
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
        $entityLoaded = SizeEntity::fromArray($dataToLoadEntity);
        
        return $entityLoaded;
    }    
}