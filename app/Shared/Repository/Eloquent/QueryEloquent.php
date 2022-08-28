<?php

namespace App\Shared\Repository\Eloquent;

use App\Shared\Dto\PageFilter\Enum\OperatorEnum;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use Illuminate\Database\Eloquent\Builder;

final class QueryEloquent
{    
  private $qry;
  private function __construct(
    private PageFilterEntity $pageFilterEntity,
    private Builder $queryBuilder,
  ){
    $this->qry = $queryBuilder;    
  }

  public static function make(PageFilterEntity $pageFilterEntity, Builder $queryBuilder): self {
    return new self($pageFilterEntity, $queryBuilder);    
  }
  
  public function execute(): array 
  {
    return $this
      ->setColumns()
      ->setWhere()
      ->setOrWhere()
      ->setOrderBy()
      ->open();
  }

  private function setColumns(): self 
  {
    if ($this->pageFilterEntity->page?->columns) 
      $this->qry->select($this->pageFilterEntity->page->columns);

    return $this;
  }

  private function setWhere(): self 
  {
    if ($this->pageFilterEntity->filter?->where) {
      $this->qry->where(function ($query) {
        foreach ($this->pageFilterEntity->filter->where as $where) {
          foreach ($where->fieldValue as $fieldValue) {
            if ($fieldValue) {
              $formated = $this->formatOperatorAndFieldValue($where->operator, $fieldValue);
              $query->where($where->fieldName, $formated[0], $formated[1]);
            }            
          }
        }
      });      
    }
    return $this;
  }

  private function setOrWhere(): self 
  {
    if ($this->pageFilterEntity->filter?->orWhere) {
      $this->qry->where(function ($query) {
        foreach ($this->pageFilterEntity->filter->orWhere as $orWhere) {
          foreach ($orWhere->fieldValue as $fieldValue) {
            if ($fieldValue) {
              $formated = $this->formatOperatorAndFieldValue($orWhere->operator, $fieldValue);
              $query->orWhere($orWhere->fieldName, $formated[0], $formated[1]);
            }            
          }
        }
      });      
    }
    return $this;
  }

  private function setOrderBy(): self
  {
    if ($this->pageFilterEntity->filter?->orderBy) {
      foreach ($this->pageFilterEntity->filter->orderBy as $orderBy) {
          $this->qry->reorder()->orderBy($orderBy->fieldName, $orderBy->direction->value);
      }
    }    
    return $this;
  }

  private function open(): array 
  {
    // Paginação dos dados
    if ($this->pageFilterEntity->page?->isPaginate){
      // Contagem de todos os registros e número da ultima página
      $countOfAllPages = (clone $this->qry)->count();
      $lastPage = ceil(($countOfAllPages/$this->pageFilterEntity->page->limit));

      // Executar paginação e armazenar resultado em $simpleArray
      $skip = ($this->pageFilterEntity->page->current - 1) * $this->pageFilterEntity->page->limit;

      $simpleArray = $this->qry
        ->skip($skip)
        ->take($this->pageFilterEntity->page->limit)
        ->get()
        ->toArray();

      // Informações da paginação
      $meta = [
        'limit_per_page' => $this->pageFilterEntity->page->limit,
        'current_page' => $this->pageFilterEntity->page->current,
        'last_page' => $lastPage,
        'count_of_all_pages' => $countOfAllPages,
        'count_current_page' => count($simpleArray),
        'page_navigation' => [
          'first' => ($this->pageFilterEntity->page->current > 1),
          'next'  => ($this->pageFilterEntity->page->current < $lastPage),
          'prior' => ($this->pageFilterEntity->page->current > 1),
          'last'  => ($this->pageFilterEntity->page->current < $lastPage),
        ]
      ];
    } else {
      // Sem paginação
      $simpleArray = $this->qry->get()->toArray();
      $meta = null;
    }

    return [
      'result' => $simpleArray, 
      'meta' => $meta
    ];       
  }

  private function formatOperatorAndFieldValue(OperatorEnum $operator, string $fieldValue): array
  {
    return match ($operator) {
      OperatorEnum::EQUAL            => ['=', $fieldValue],
      OperatorEnum::GREATER          => ['>', $fieldValue],
      OperatorEnum::LESS             => ['<', $fieldValue],
      OperatorEnum::GREATER_OR_EQUAL => ['>=', $fieldValue],
      OperatorEnum::LESS_OR_EQUAL    => ['<=', $fieldValue],
      OperatorEnum::DIFFERENT        => ['<>', $fieldValue],
      OperatorEnum::LIKE_INITIAL     => ['like', $fieldValue.'%'],
      OperatorEnum::LIKE_FINAL       => ['like', '%'.$fieldValue],
      OperatorEnum::LIKE_ANYWHERE    => ['like', '%'.$fieldValue.'%'],
      OperatorEnum::LIKE_EQUAL       => ['like', $fieldValue],
    };
  }
}