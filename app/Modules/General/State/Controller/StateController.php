<?php

namespace App\Modules\General\State\Controller;

use App\Modules\General\State\Repository\StateRepositoryInterface;
use App\Modules\General\State\Resource\StateIndexResource;
use App\Modules\General\State\Resource\StateQueryResource;
use App\Modules\General\State\Resource\StateShowResource;
use App\Modules\General\State\Domain\Service\StateService;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class StateController extends Controller
{
  public function __construct(private StateRepositoryInterface $repository){
    $this->service = StateService::make($this->repository);
  }

  public function index()
  {
    $dataResult = new StateIndexResource($this->service->index());
    return Res::success($dataResult);
  }

  public function show(int $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new StateShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new StateQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}