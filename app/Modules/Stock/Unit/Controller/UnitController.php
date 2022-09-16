<?php

namespace App\Modules\Stock\Unit\Controller;

use App\Modules\Stock\Unit\Dto\UnitDto;
use App\Modules\Stock\Unit\Resource\UnitIndexResource;
use App\Modules\Stock\Unit\Resource\UnitQueryResource;
use App\Modules\Stock\Unit\Resource\UnitShowResource;
use App\Modules\Stock\Unit\Domain\Service\UnitService;
use App\Modules\Stock\Unit\Repository\UnitRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class UnitController extends Controller
{
  protected UnitService $service;
  public function __construct(private UnitRepositoryInterface $repository){
    $this->service = UnitService::make($this->repository);
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
    $resource = new UnitIndexResource($index);
    
    return Res::success($resource);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success ( new UnitShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(UnitDto $dto)
  {
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new UnitShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(UnitDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new UnitShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new UnitQueryResource($query);
    
    return Res::success($resource);
  }
}