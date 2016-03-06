<?php

namespace rdx\laraveleagerrelationships;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HasManyWith extends HasMany {

  /**
   * This relationship's far-away relationship name to the outside model. Will be used in with().
   */
  protected $with = [];

  /**
   * Create a new has one or many relationship instance.
   */
  public function __construct(Builder $query, Model $parent, $foreignKey, $localKey, $with) {
    $this->with = $with;

    parent::__construct($query, $parent, $foreignKey, $localKey);
  }

  /**
   * Override Illuminate\Database\Eloquent\Relations\HasMany::getResults().
   *
   * Always eager load the far-away relationship, without having to mention it in the app anywhere.
   */
  public function getResults() {
    return $this->with($this->with)->query->get();
  }

}
