<?php

namespace App\Modules\General\Person\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\BaseModelEloquent;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonContactModelEloquent extends BaseModelEloquent
{
  use HasFactory, UuidTrait;

  protected $table = 'person_contact';
  protected $fillable = [
    'person_id',
    'name',
    'ein',
    'type',
    'note',
    'phone',
    'email',
  ];
  
  protected $casts = [
  ];
  
  public $timestamps = false;
}
