<p align="center">
    <a href="https://travis-ci.org/gwleuverink/eloquent-hashid-binding"><img src="https://travis-ci.org/gwleuverink/eloquent-hashid-binding.svg?branch=master" alt="Build Status"></a>
    <a href='https://coveralls.io/github/gwleuverink/eloquent-hashid-binding?branch=master'><img src='https://coveralls.io/repos/github/gwleuverink/eloquent-hashid-binding/badge.svg?branch=master' alt='Coverage Status' /></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/v/unstable.svg" alt="Latest Unstable Version"></a>
    <a href="https://packagist.org/packages/leuverink/eloquent-hashid-binding"><img src="https://poser.pugx.org/leuverink/eloquent-hashid-binding/license.svg" alt="License"></a>
</p>

---
**NOTE**
The hashid route keys are encoded/decoded on the fly. You can drop this in any project without the need of migrations.
---

## Installation

`composer require leuverink\eloquent-hashid-binding`

## Usage

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
