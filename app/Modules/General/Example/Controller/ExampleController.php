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
    $dataResult = new ExampleIndexResource($this->service->index());
    return Res::success($dataResult);
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
    $entityStored = $this->service->store($dto->toEntity());
    $dataResult   = new ExampleShowResource($entityStored);
    
    return Res::success($dataResult, Response::HTTP_CREATED);
  }

  public function update(ExampleDto $dto, string $id)
  {
    $entityUpdated = $this->service->update($dto->toEntity(), $id);
    $dataResult    = new ExampleShowResource($entityUpdated);

    return Res::success($dataResult);
  }

  public function query(PageFilterDto $dto)
  {
    $dataResult = new ExampleQueryResource($this->service->query($dto->toEntity()));
    return Res::success($dataResult);
  }
}