<?php

namespace rdx\laraveleagerrelationships;

use rdx\laraveleagerrelationships\HasManyWith;

trait HasRelationshipsWith {

  /**
   *
   */
  public function hasManyWith($related, $foreignKey, $localKey, $with) {
    $instance = new $related;
    $foreignKey = $instance->getTable() . '.' . ($foreignKey ?: $this->getForeignKey());
    $localKey = $localKey ?: $this->getKeyName();

    return new HasManyWith($instance->newQuery(), $this, $foreignKey, $localKey, $with);
  }

}
