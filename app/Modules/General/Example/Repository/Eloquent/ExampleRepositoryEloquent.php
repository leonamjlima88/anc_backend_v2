<?php

namespace App\Modules\General\Example\Repository\Eloquent;

use App\Modules\General\Example\Domain\Entity\ExampleEntity;
use App\Modules\General\Example\Repository\ExampleRepositoryInterface;
use App\Shared\Entity\BaseEntity;
use App\Shared\Repository\Eloquent\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class ExampleRepositoryEloquent extends BaseRepositoryEloquent implements ExampleRepositoryInterface
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
        $entityLoaded = ExampleEntity::fromArray($dataToLoadEntity);
        
        return $entityLoaded;
    }    
}