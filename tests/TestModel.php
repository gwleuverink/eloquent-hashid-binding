<?php

namespace Leuverink\HashidBinding\Tests;

use Illuminate\Database\Eloquent\Model;
use Leuverink\HashidBinding\HashidBinding;

class TestModel extends Model
{
    use HashidBinding;

    protected $table = 'hashid_binding_test';
    protected $guarded = [];
    public $timestamps = false;
}
