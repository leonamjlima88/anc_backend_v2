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
    $dataResult = new StorageLocationIndexResource($this->service->index());
    return Res::success($dataResult);
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
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new StorageLocationShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(StorageLocationDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new StorageLocationShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new StorageLocationQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}