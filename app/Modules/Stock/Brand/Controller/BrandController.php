<?php

namespace App\Modules\Stock\Brand\Controller;

use App\Modules\Stock\Brand\Dto\BrandDto;
use App\Modules\Stock\Brand\Resource\BrandIndexResource;
use App\Modules\Stock\Brand\Resource\BrandQueryResource;
use App\Modules\Stock\Brand\Resource\BrandShowResource;
use App\Modules\Stock\Brand\Domain\Service\BrandService;
use App\Modules\Stock\Brand\Repository\BrandRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class BrandController extends Controller
{
  protected BrandService $service;
  public function __construct(private BrandRepositoryInterface $repository){
    $this->service = BrandService::make($this->repository);
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
    $resource = new BrandIndexResource($index);
    
    return Res::success($resource);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new BrandShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(BrandDto $dto)
  {
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new BrandShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(BrandDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new BrandShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new BrandQueryResource($query);
    
    return Res::success($resource);
  }
}