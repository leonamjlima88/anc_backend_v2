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
    $dataResult = new BrandIndexResource($this->service->index());
    return Res::success($dataResult);
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
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new BrandShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(BrandDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new BrandShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new BrandQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}