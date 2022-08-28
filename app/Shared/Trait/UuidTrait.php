<?php

namespace App\Shared\Trait;

trait UuidTrait
{
  /**
   * Boot function from Laravel.
   */
  protected static function boot()
  {
      parent::boot();
      static::creating(function ($model) {
          if (empty($model->{$model->getKeyName()})) {
              $model->{$model->getKeyName()} = makeUuid();
          }
      });
  }
   
  /**
   * Get the value indicating whether the IDs are incrementing.
   *
   * @return bool
   */
  public function getIncrementing()
  {
      return false;
  }

  /**
   * Get the auto-incrementing key type.
   *
   * @return string
   */
  public function getKeyType()
  {
      return 'string';
  }
}