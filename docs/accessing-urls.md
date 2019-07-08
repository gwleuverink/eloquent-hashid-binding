## Generating url's
Navigating to a model implementing HashidBinding using it's id now results in a 404 response. The encoded route key can be resolved automatically using the route helper.

``` php
// Assuming $user is a model instance using the HashidBinding trait, both functions below will generate "domain.test/users/rvBVv"
url('users', $user);
route('users:find' $user);
```

## Accessing the encoded route key
The encoded route key is automatically added to each model instance using an accessor and appended to the serialized model also.

``` php
// Get the encoded route key property
$model->encodedRouteKey;

// Retreive it from a model after being serialized
$model = json_decode($model->toJson());
$model->encoded_route_key;
```
