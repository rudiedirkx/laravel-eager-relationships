Eager relationship loading
====

If you want certain relationships to eager load depending relationships, but not
always on the same models.

Different from `protected $with`
----

`protected $with` on a model **always** loads those relationships when the model is
loaded. If you want automatic eager loading sometimes, but not always, this is for you.

Usage
----

Add the trait to your model:

	use rdx\laraveleagerrelationships\HasRelationshipsWith;

	class User extends Model {
		use HasRelationshipsWith;
	}

And change the model's relationships to use its methods:

	public function posts() {
		return $this->hasManyWith('categories', Category::class);
	}

The differences:

* Add `With` to the method name: `belongsTo` becomes `belongsToWith` etc
* The first argument must be a valid `with()` argument:
    * string: `'categories'`
    * array: `['categories', 'domains', 'logs']`

Which relationships?
----

All current (Laravel 5.2) relationships:

* `hasManyWith`
* `belongsToManyWith`
* `morphOneWith`
* `hasOneWith`
* `belongsToWith`
* `morphToWith`
* `hasManyThroughWith`
* `morphManyWith`
* `morphToManyWith`
* `morphedByManyWith`

But I've tested only a few.
