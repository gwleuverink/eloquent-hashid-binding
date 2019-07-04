<?php

return [
    'salt' => env('HASHID_BINDING_SALT', config('app.key')),
    'length' => env('HASHID_BINDING_LENGTH', 5)
];