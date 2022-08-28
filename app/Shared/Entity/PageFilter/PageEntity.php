<?php

namespace App\Shared\Entity\PageFilter;

final class PageEntity
{
  private PageFilterEntity $owner;

  public function __construct(
    public ?bool $isPaginate = true,
    public ?int $limit = 15,
    public ?int $current = 0,
    public ?array $columns = null,
  ) {
  }

  public function setOwner(PageFilterEntity $owner){
    $this->owner = $owner;
  }

  public function end(){
    return $this->owner;
  }

  public function config(bool $isPaginate, int $limit, int $current, ?array $columns): self
  {
    $this->isPaginate = $isPaginate;
    $this->limit = $limit;
    $this->current = $current;
    $this->columns = $columns;
    
    return $this;
  }
}