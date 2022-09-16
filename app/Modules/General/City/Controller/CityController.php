<?php

namespace App\Modules\General\City\Controller;

use App\Modules\General\City\Resource\CityIndexResource;
use App\Modules\General\City\Resource\CityQueryResource;
use App\Modules\General\City\Resource\CityShowResource;
use App\Modules\General\City\Domain\Service\CityService;
use App\Modules\General\City\Repository\CityRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class CityController extends Controller
{
  protected CityService $service;
  public function __construct(private CityRepositoryInterface $repository){
    $this->service = CityService::make($this->repository);
  }

  public function index()
  {
    $index    = $this->service->index();
    $resource = new CityIndexResource($index);    
    $dataResult = new CityIndexResource($this->service->index());    
    
    return Res::success($resource);
  }

  public function show(int $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new CityShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new CityQueryResource($query);

    return Res::success($resource);
  }
}