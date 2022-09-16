<?php

namespace App\Modules\General\Example\Controller;

use App\Modules\General\Example\Dto\ExampleDto;
use App\Modules\General\Example\Resource\ExampleIndexResource;
use App\Modules\General\Example\Resource\ExampleQueryResource;
use App\Modules\General\Example\Resource\ExampleShowResource;
use App\Modules\General\Example\Domain\Service\ExampleService;
use App\Modules\General\Example\Repository\ExampleRepositoryInterface;
use App\Shared\Controller\Controller;
use App\Shared\Dto\PageFilter\PageFilterDto;
use App\Shared\util\Res;
use Illuminate\Http\Response;

class ExampleController extends Controller
{
  protected ExampleService $service;
  public function __construct(private ExampleRepositoryInterface $repository){
    $this->service = ExampleService::make($this->repository);
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
    $resource = new ExampleIndexResource($index);
    
    return Res::success($resource);
  }

  public function show(string $id)
  {
    $entityFound = $this->service->show($id);

    return ($entityFound)
      ? Res::success (new ExampleShowResource($entityFound))
      : Res::error   (code: Response::HTTP_NOT_FOUND);
  }

  public function store(ExampleDto $dto)
  {
    $entity       = $dto->toEntity();
    $entityStored = $this->service->store($entity);
    $resource     = new ExampleShowResource($entityStored);
    
    return Res::success($resource, Response::HTTP_CREATED);
  }

  public function update(ExampleDto $dto, string $id)
  {
    $entity        = $dto->toEntity();
    $entityUpdated = $this->service->update($entity, $id);
    $resource      = new ExampleShowResource($entityUpdated);

    return Res::success($resource);
  }

  public function query(PageFilterDto $dto)
  {
    $entity   = $dto->toEntity();
    $query    = $this->service->query($entity);
    $resource = new ExampleQueryResource($query);
    
    return Res::success($resource);
  }
}