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
  public function __construct(private CityRepositoryInterface $repository){
    $this->service = CityService::make($this->repository);
  }

  public function index()
  {
    $dataResult = new CityIndexResource($this->service->index());    
    
    return Res::success($dataResult);
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
    $dataResult = new CityQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}