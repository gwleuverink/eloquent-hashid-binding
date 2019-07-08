<?php

return [
    'salt' => env('HASHID_BINDING_SALT', config('app.key')),
    'min_length' => env('HASHID_BINDING_MIN_LENGTH', 5),
];
