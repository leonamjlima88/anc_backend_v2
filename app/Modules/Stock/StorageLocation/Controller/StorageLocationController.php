<?php

namespace App\Modules\Stock\StorageLocation\Controller;

use App\Modules\Stock\StorageLocation\Dto\StorageLocationDto;
use App\Modules\Stock\StorageLocation\Resource\StorageLocationIndexResource;
use App\Modules\Stock\StorageLocation\Resource\StorageLocationQueryResource;
use App\Modules\Stock\StorageLocation\Resource\StorageLocationShowResource;
use App\Modules\Stock\StorageLocation\Domain\Service\StorageLocationService;
use App\Modules\Stock\StorageLocation\Repository\StorageLocationRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class StorageLocationController extends Controller
{
  protected StorageLocationService $service;
  public function __construct(private StorageLocationRepositoryInterface $repository){
    $this->service = StorageLocationService::make($this->repository);
  }

  public function destroy(string $id)
  {
    return $this->service->destroy($id) 
      ? Res::success (code: Response::HTTP_NO_CONTENT)
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function index()
  {
    $index    = $this->service->index();
    $resource = new StorageLocationIndexResource($index);
    
    return Res::success($resource);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new StorageLocationShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(StorageLocationDto $dto)
  {
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new StorageLocationShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(StorageLocationDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new StorageLocationShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new StorageLocationQueryResource($query);
    
    return Res::success($resource);
  }
}