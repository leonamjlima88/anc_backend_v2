<?php 

namespace App\Shared\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class BaseFactoryEloquent
{
    public function __construct(private Model $model){}  

    /**
     * Gerar array de dados sem persistir
     *
     * @param array $attributes
     * @return array $notPersisted
     */
    public function generate(array $attributes = []): array
    {
        return $this->model->factory()
            ->make($attributes)
            ->toArray();
    } 

    /**
     * Persistir dados
     *
     * @param integer $count
     * @param array $attributes
     * @return array $created
     */
    public function create(int $count = 1, array $attributes = []): array
    {
        $created = $this->model->factory($count)
            ->create($attributes)
            ->toArray();
            
        return ($count === 1) 
            ? $created[0] 
            : $created;
    }
}
