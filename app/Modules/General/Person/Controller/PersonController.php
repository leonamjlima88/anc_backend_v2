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
  protected PersonService $service;
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
    $index    = $this->service->index();
    $resource = new PersonIndexResource($index);

    return Res::success($resource);
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
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new PersonShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(PersonDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new PersonShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new PersonQueryResource($query);

    return Res::success($resource);
  }
}