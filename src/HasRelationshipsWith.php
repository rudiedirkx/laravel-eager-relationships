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

  /**
   *
   */
  public function belongsToManyWith($related, $table, $foreignKey, $otherKey, $relation = null, $with) {
    // If no relationship name was passed, we will pull backtraces to get the
    // name of the calling function. We will use that function name as the
    // title of this relation since that is a great convention to apply.
    if (is_null($relation)) {
        $relation = $this->getBelongsToManyCaller();
    }

    // First, we'll need to determine the foreign key and "other key" for the
    // relationship. Once we have determined the keys we'll make the query
    // instances as well as the relationship instances we need for this.
    $foreignKey = $foreignKey ?: $this->getForeignKey();

    $instance = new $related;

    $otherKey = $otherKey ?: $instance->getForeignKey();

    // If no table name was provided, we can guess it by concatenating the two
    // models using underscores in alphabetical order. The two model names
    // are transformed to snake case from their default CamelCase also.
    if (is_null($table)) {
        $table = $this->joiningTable($related);
    }

    // Now we're ready to create a new query builder for the related model and
    // the relationship instances for the relation. The relations will set
    // appropriate query constraint and entirely manages the hydrations.
    $query = $instance->newQuery();

    return new BelongsToManyWith($query, $this, $table, $foreignKey, $otherKey, $relation, $with);
  }

}
