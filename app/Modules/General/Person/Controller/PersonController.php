<?php

namespace App\Modules\General\Person\Controller;

use App\Modules\General\Person\Dto\PersonDto;
use App\Modules\General\Person\Repository\PersonRepositoryInterface;
use App\Modules\General\Person\Resource\PersonIndexResource;
use App\Modules\General\Person\Resource\PersonQueryResource;
use App\Modules\General\Person\Resource\PersonShowResource;
use App\Modules\General\Person\Domain\Service\PersonService;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class PersonController extends Controller
{
  public function __construct(private PersonRepositoryInterface $repository){
    $this->service = PersonService::make($this->repository);
  }

  public function destroy(string $id)
  {
    return $this->service->destroy($id) 
      ? Res::success (code: Response::HTTP_NO_CONTENT)
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function index()
  {
    $dataResult = new PersonIndexResource($this->service->index());
    return Res::success($dataResult);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new PersonShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(PersonDto $dto)
  {
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new PersonShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(PersonDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new PersonShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new PersonQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}