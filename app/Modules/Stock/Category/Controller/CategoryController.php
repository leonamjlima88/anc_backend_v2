<?php

namespace App\Modules\Stock\Category\Controller;

use App\Modules\Stock\Category\Dto\CategoryDto;
use App\Modules\Stock\Category\Resource\CategoryIndexResource;
use App\Modules\Stock\Category\Resource\CategoryQueryResource;
use App\Modules\Stock\Category\Resource\CategoryShowResource;
use App\Modules\Stock\Category\Domain\Service\CategoryService;
use App\Modules\Stock\Category\Repository\CategoryRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
  protected CategoryService $service;
  public function __construct(private CategoryRepositoryInterface $repository){
    $this->service = CategoryService::make($this->repository);
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
    $resource = new CategoryIndexResource($index);
    
    return Res::success($resource);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new CategoryShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(CategoryDto $dto)
  {
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new CategoryShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(CategoryDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new CategoryShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new CategoryQueryResource($query);
    
    return Res::success($resource);
  }
}