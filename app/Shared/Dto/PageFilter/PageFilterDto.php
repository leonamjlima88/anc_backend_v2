<?php

namespace App\Shared\Dto\PageFilter;

use App\Shared\Entity\PageFilter\PageFilterEntity;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * Exemplo de Estrutura Json
 * 
 * {
 * 	"page": {
 * 		"isPaginate": true,
 * 		"limit": 10,
 * 		"current": 1,
 * 		"columns": []
 * 	},
 * 	"filter": {
 * 		"orderBy": [
 * 			{
 * 				"fieldName": "name",
 * 				"direction": "asc"
 * 			}			
 * 		],
 * 		"where": [
 * 			{
 * 				"fieldName": "name",
 * 				"operator": "likeAnywhere",
 * 				"fieldValue": [
 * 					"",
 * 					""
 * 				]
 * 			}
 * 		],
 * 		"orWhere": [
 * 			{
 * 				"fieldName": "name",
 * 				"operator": "likeAnywhere",
 * 				"fieldValue": [
 * 					"",
 * 					""
 * 				]
 * 			}
 * 		]
 * 	}
 * }
*/
class PageFilterDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable')]
    public ?PageDto $page,
    
    #[Rule('nullable')]
    public ?FilterDto $filter,

    #[Rule('nullable')]
    public ?array $filterEx = [],
  ) {
  }

  public function toEntity(): ?PageFilterEntity
  {
    $entity = PageFilterEntity::make();
    $entity->filterEx = $this->filterEx;
    
    if ($this->page)             $entity->openPage()->config(...$this->page?->toArray());
    if ($this->filter?->where)   $entity->openFilter()->addWhereCollection($this->filter->where->toArray());    
    if ($this->filter?->orWhere) $entity->openFilter()->addOrWhereCollection($this->filter->orWhere->toArray());    
    if ($this->filter?->orderBy) $entity->openFilter()->addOrderByCollection($this->filter->orderBy->toArray());        
        
    return $entity;    
  }
}
