<?php

namespace rdx\laraveleagerrelationships;

trait HasRelationshipsWith {

  /**
   *
   */
  public function hasManyWith($related, $foreignKey, $localKey, $with) {
    $relationship = $this->hasMany($related, $foreignKey, $localKey);
    $relationship->getQuery()->with($with);
    return $relationship;
  }

  /**
   *
   */
  public function belongsToManyWith($related, $table, $foreignKey, $otherKey, $relation = null, $with) {
    $relationship = $this->belongsToMany($related, $table, $foreignKey, $otherKey, $relation);
    $relationship->getQuery()->with($with);
    return $relationship;
  }

}
