<?php

namespace App\Shared\Repository\Eloquent;

use App\Shared\Entity\BaseEntity;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\Eloquent\QueryEloquent;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Repository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepositoryEloquent implements BaseRepositoryInterface
{
    protected bool $inTransaction = true;
    public function __construct(private Model $model){}  
    
    public function index(): array {
        return $this->model->get()->toArray();
    }

    public function store(BaseEntity $entity): BaseEntity {
        // Método anônimo para incluir
        $dataToStore = $entity->toArray();
        $executeStore = function ($dataToStore) {
            $modelStored = $this->model->create($dataToStore);

            return $this->show($modelStored->id);
        };

        // Controle de Transação
        $entityStored = match ($this->inTransaction) {
            true => DB::transaction(fn () => $executeStore($dataToStore)),
            false => $executeStore($dataToStore),
        };

        return $entityStored;
    }

    public function show(string|int $id): ?BaseEntity
    {
        return ($modelFound = $this->findById($id))
          ? $this->modelToEntity($modelFound)
          : null;        
    }

    public function update(BaseEntity $entity, string|int $id): BaseEntity
    {
        // Localizar Model
        $modelFound = $this->findById($id);
        throw_if(!$modelFound, new ModelNotFoundException(trans('message_lang.model_not_found') . ' Id: ' . $id));

        // Método anônimo para atualizar
        $dataToUpdate = $entity->toArray();
        $executeUpdate = function ($dataToUpdate) use ($modelFound) {
            // Atualizar Example
            tap($modelFound)->update($dataToUpdate);
        
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
            ->where($this->model->getTable().'.id', $id)
            ->first();
    }

    public function destroy(string|int $id): bool
    {
        return ($modelFound = $this->model->find($id)) 
            ? $modelFound->delete()
            : false;
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
            ->select(
                $this->model->getTable().'.*',
            )
            ->orderBy($this->model->getTable().'.id');

        return QueryEloquent::make($pageFilterEntity, $queryBuilder)->execute();
    }


    /**
     * Habilitar/Desabilitar Transação de Dados
     *
     * @param boolean $value
     * @return self
     */
    public function setTransaction(bool $value): self {
        $this->inTransaction = $value;
        return $this;
    }
}