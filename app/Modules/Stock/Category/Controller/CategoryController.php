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
    $dataResult = new CategoryIndexResource($this->service->index());
    return Res::success($dataResult);
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
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new CategoryShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(CategoryDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new CategoryShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new CategoryQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}