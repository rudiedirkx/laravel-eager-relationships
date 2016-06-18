<?php

namespace rdx\laraveleagerrelationships;

trait HasRelationshipsWith {

  /**
   * Set-up any base relationship and add eager relationships.
   */
  protected function _extendRelationShipWith($method, $with, $args) {
    $args = array_slice($args, 1);

    $relationship = call_user_func_array([$this, $method], $args);
    $relationship->getQuery()->with($with);

    return $relationship;
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::hasMany().
   */
  public function hasManyWith($with, $related, $foreignKey = null, $localKey = null) {
    return $this->_extendRelationShipWith('hasMany', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::belongsToMany().
   */
  public function belongsToManyWith($with, $related, $table = null, $foreignKey = null, $otherKey = null, $relation = null) {
    return $this->_extendRelationShipWith('belongsToMany', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::morphOne().
   */
  public function morphOneWith($with, $related, $name, $type = null, $id = null, $localKey = null) {
    return $this->_extendRelationShipWith('morphOne', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::hasOne().
   */
  public function hasOneWith($with, $related, $foreignKey = null, $localKey = null) {
    return $this->_extendRelationShipWith('hasOne', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::belongsTo().
   */
  public function belongsToWith($with, $related, $foreignKey = null, $otherKey = null, $relation = null) {
    return $this->_extendRelationShipWith('belongsTo', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::morphTo().
   */
  public function morphToWith($with, $name = null, $type = null, $id = null) {
    return $this->_extendRelationShipWith('morphTo', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::hasManyThrough().
   */
  public function hasManyThroughWith($with, $related, $through, $firstKey = null, $secondKey = null, $localKey = null) {
    return $this->_extendRelationShipWith('hasManyThrough', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::morphMany().
   */
  public function morphManyWith($with, $related, $name, $type = null, $id = null, $localKey = null) {
    return $this->_extendRelationShipWith('morphMany', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::morphToMany().
   */
  public function morphToManyWith($with, $related, $name, $table = null, $foreignKey = null, $otherKey = null, $inverse = false) {
    return $this->_extendRelationShipWith('morphToMany', $with, func_get_args());
  }

  /**
   * Wrapper for Illuminate\Database\Eloquent\Model::morphedByMany().
   */
  public function morphedByManyWith($with, $related, $name, $table = null, $foreignKey = null, $otherKey = null) {
    return $this->_extendRelationShipWith('morphedByMany', $with, func_get_args());
  }

}
