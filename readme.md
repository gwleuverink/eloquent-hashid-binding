<p align="center">
    <img src=".github/open-graph-logo.png">
    <a href="https://travis-ci.org/gwleuverink/eloquent-hashid-binding"><img src="https://travis-ci.org/gwleuverink/eloquent-hashid-binding.svg?branch=master" alt="Build Status"></a>
    <a href='https://coveralls.io/github/gwleuverink/eloquent-hashid-binding?branch=master'><img src='https://coveralls.io/repos/github/gwleuverink/eloquent-hashid-binding/badge.svg?branch=master' alt='Coverage Status' /></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/v/unstable.svg" alt="Latest Unstable Version"></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/license.svg" alt="License"></a>
</p>

<p align="center">
    <b>Still under construction!</b>
    <br />
    A drop in solution for eloquent implicit route model binding with hashid's. 
    <br />
    Obfuscate your app's id's for prying eyes.
</p>


## Installation

`composer require leuverink\eloquent-hashid-binding`

## Basic usage

Simply use the HashidBinding trait in your eloquent model and you're good to go!

``` php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Leuverink\HashidBinding\HashidBinding;

class User extends Authenticatable
{
    use HashidBinding;

    //
}
```

## Generating url's with the encoded route key
Navigating to this model using it's id now results in a 404 response. The encoded route key can be resolved automatically using the route helper.

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

## Customisation
### Salt
By default this package salts route keys the model's fully qualified class name combined with your app key. If you'd like to change this behaviour, for example when you use a rotating app key, simply add `HASHID_BINDING_SALT` to your environment file.

### Hashid length
The default length for encoded route keys is five characters. This can be changed by adding *(int)* `HASHID_BINDING_LENGTH` to your environment file.

### Publishing the package config
By default all settings can be changed using environment variables. If you have the need to do this via a config file this is possible also. Simply run the following command:
`php artisan vendor:publish --tag"hashid-binding"` and make your changes there.

# Contributing
I consider this package pretty much feature complete. Any contributions concerning bugfixes, documentation or allround great ideas are more than welcome. Please open up an issue and discuss.

## Getting it running
Clone this repository and `composer install`

## Running tests
Run `composer test` to run the suite. Alternatively run `composer test-coverage` to also generate a full coverage report inside `build/reports`
