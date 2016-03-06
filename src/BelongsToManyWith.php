<?php

namespace rdx\laraveleagerrelationships;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BelongsToManyWith extends BelongsToMany {

  /**
   * This relationship's far-away relationship name to the outside model. Will be used in with().
   */
  protected $with = [];

  /**
   * Create a new has one or many relationship instance.
   */
  public function __construct(Builder $query, Model $parent, $table, $foreignKey, $otherKey, $relation, $with) {
    $this->with = $with;

    parent::__construct($query, $parent, $table, $foreignKey, $otherKey, $relation);
  }

  /**
   * Override Illuminate\Database\Eloquent\Relations\BelongsToMany::getResults().
   *
   * Always eager load the far-away relationship, without having to mention it in the app anywhere.
   */
  public function getResults() {
    return $this->with($this->with)->query->get();
  }

}
