<p align="center">
    <img src="docs/assets/package-logo.png" width="500">
</p>

<p align="center">
    <a href="https://travis-ci.org/gwleuverink/eloquent-hashid-binding"><img src="https://travis-ci.org/gwleuverink/eloquent-hashid-binding.svg?branch=master" alt="Build Status"></a>
    <a href='https://coveralls.io/github/gwleuverink/eloquent-hashid-binding?branch=master'><img src='https://coveralls.io/repos/github/gwleuverink/eloquent-hashid-binding/badge.svg?branch=master' alt='Coverage Status' /></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/v/unstable.svg" alt="Latest Unstable Version"></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/license.svg" alt="License"></a>
</p>

<p align="center">
    A drop in solution for eloquent implicit route model binding with hashid's. 
    <br />
    Obfuscate your app's id's from prying eyes.
</p>

<br />

---

***What this package does***

This package obfuscates eloquent model's id's when used in url's. This is really usefull when you don't want to expose id's to the outside world.

The route keys are encoded/decoded on the fly. You can drop this in any Laravel project without the need for migrations.

| **EXAMPLE** |                           |
| ----------- | ------------------------- |
| Before      | `domain.test/users/1`     |
| After       | `domain.test/users/rvBVv` |

---
<br />

## Installation

`composer require leuverink/eloquent-hashid-binding`

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

That's it!
Check out [the docs](https://gwleuverink.github.io/eloquent-hashid-binding/) for more information.
