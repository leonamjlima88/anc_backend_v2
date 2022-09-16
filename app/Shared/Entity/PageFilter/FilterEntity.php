<?php

namespace App\Shared\Entity\PageFilter;

use App\Shared\Dto\PageFilter\Enum\DirectionEnum;
use App\Shared\Dto\PageFilter\Enum\OperatorEnum;

final class FilterEntity
{
  private PageFilterEntity $owner;

  public function __construct(
    /**
     * @var OrderByEntity[] $orderBy
     */
    public ?array $orderBy = [],
    
    /**
     * @var WhereEntity[] $where
     */
    public ?array $where = [],
    
    /**
     * @var OrWhereEntity[] $orWhere
     */
    public ?array $orWhere = [],
  ) {
  }

  public function setOwner(PageFilterEntity $owner){
    $this->owner = $owner;
  }

  public function end(){
    return $this->owner;
  }

  public function addWhere(string $fieldName, OperatorEnum $operator, array $fieldValue): self {
    $where = new WhereEntity(
      $fieldName,
      $operator,
      $fieldValue,
    );
    array_push($this->where, $where);

    return $this;
  }

  public function addOrWhere(string $fieldName, OperatorEnum $operator, array $fieldValue): self {
    $orWhere = new WhereEntity(
      $fieldName,
      $operator,
      $fieldValue,
    );
    array_push($this->orWhere, $orWhere);

    return $this;
  }

  public function addOrderBy(string $fieldName, DirectionEnum $direction): self {
    $orderBy = new OrderByEntity(
      $fieldName,
      $direction,
    );
    array_push($this->orderBy, $orderBy);

    return $this;
  }

  public function addWhereCollection(array $collection): self {
    foreach ($collection as $value) {
      $this->addWhere(
        $value['fieldName'],
        OperatorEnum::from($value['operator']),
        $value['fieldValue'],
      );
    }

    return $this;
  }

  public function addOrWhereCollection(array $collection): self {
    foreach ($collection as $value) {
      $this->addOrWhere(
        $value['fieldName'],
        OperatorEnum::from($value['operator']),
        $value['fieldValue'],
      );
    }

    return $this;
  }

  public function addOrderByCollection(array $collection): self {
    foreach ($collection as $value) {
      $this->addOrderBy(
        $value['fieldName'],
        DirectionEnum::from($value['direction']),        
      );
    }

    return $this;
  }
}
