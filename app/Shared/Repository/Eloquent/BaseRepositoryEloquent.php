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

    /**
     * Incluir
     *
     * @param BaseEntity $entity
     * @return string $id
     */
    public function store(BaseEntity $entity): string
    {
        // Método anônimo para incluir
        $dataToStore = $entity->toArray();        
        $executeStore = function ($dataToStore) {
            $modelStored = $this->model->create($dataToStore);

            return $modelStored->id;
        };

        // Controle de Transação
        return match ($this->inTransaction) {
            true => DB::transaction(fn () => $executeStore($dataToStore)),
            false => $executeStore($dataToStore),
        };
    }

    /**
     * Localizar por ID
     *
     * @param string|integer $id
     * @return BaseEntity|null $entity
     */
    public function show(string|int $id): ?BaseEntity
    {
        return ($modelFound = $this->findById($id))
          ? $this->modelToEntity($modelFound)
          : null;        
    }

    /**
     * Atualizar
     *
     * @param BaseEntity $entity
     * @param string|integer $id
     * @return boolean $itWorked
     */
    public function update(BaseEntity $entity, string|int $id): bool
    {
        // Localizar Model
        $modelFound = $this->findById($id);
        throw_if(!$modelFound, new ModelNotFoundException(trans('message_lang.model_not_found') . ' Id: ' . $id));

        // Método anônimo para atualizar
        $dataToUpdate = $entity->toArray();
        $executeUpdate = function ($dataToUpdate) use ($modelFound) {
            return $modelFound->update($dataToUpdate);
        };

        // Controle de Transação
        return match ($this->inTransaction) {
            true => DB::transaction(fn () => $executeUpdate($dataToUpdate)),
            false => $executeUpdate($dataToUpdate),
        };
    }

    /**
     * Localizar por ID e retornar Model
     *
     * @param string|integer $id
     * @return Model|null $model
     */
    protected function findById(string|int $id): ?Model
    {
        return $this->model
            ->where($this->model->getTable().'.id', $id)
            ->first();
    }

    /**
     * Deletar
     *
     * @param string|integer $id
     * @return boolean $itWorked
     */
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
     * @return array $result
     */
    public function query(PageFilterEntity $pageFilterEntity): array
    {
        // QueryBuilder Base
        $queryBuilder = $this->model
            ->query()
            ->select($this->model->getTable().'.*')
            ->orderBy($this->model->getTable().'.id');

        return QueryEloquent::make($pageFilterEntity, $queryBuilder)->execute();
    }


    /**
     * Habilitar/Desabilitar Transação de Dados
     *
     * @param boolean $value
     * @return self $this
     */
    public function setTransaction(bool $value): self {
        $this->inTransaction = $value;
        return $this;
    }
}