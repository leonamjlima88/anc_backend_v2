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
    $dataResult = new UnitIndexResource($this->service->index());
    return Res::success($dataResult);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new UnitShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(UnitDto $dto)
  {
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new UnitShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(UnitDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new UnitShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new UnitQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}