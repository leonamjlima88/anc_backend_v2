<?php

namespace App\Modules\Stock\Size\Controller;

use App\Modules\Stock\Size\Dto\SizeDto;
use App\Modules\Stock\Size\Resource\SizeIndexResource;
use App\Modules\Stock\Size\Resource\SizeQueryResource;
use App\Modules\Stock\Size\Resource\SizeShowResource;
use App\Modules\Stock\Size\Domain\Service\SizeService;
use App\Modules\Stock\Size\Repository\SizeRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class SizeController extends Controller
{
  protected SizeService $service;
  public function __construct(private SizeRepositoryInterface $repository){
    $this->service = SizeService::make($this->repository);
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
    $resource = new SizeIndexResource($index);
    
    return Res::success($resource);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new SizeShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(SizeDto $dto)
  {
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new SizeShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(SizeDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new SizeShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new SizeQueryResource($query);
    
    return Res::success($resource);
  }
}