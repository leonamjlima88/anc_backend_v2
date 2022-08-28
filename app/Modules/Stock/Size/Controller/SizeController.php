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
    $dataResult = new SizeIndexResource($this->service->index());
    return Res::success($dataResult);
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
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new SizeShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(SizeDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new SizeShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new SizeQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}