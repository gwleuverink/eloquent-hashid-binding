## Configuration

### Salt
By default this package salts route keys the model's fully qualified class name combined with your app key. If you'd l]ike to change this behaviour, for example when you use a rotating app key, simply add `HASHID_BINDING_SALT` to your environment file.

### Minimom key length
The default minimum length for encoded route keys is five characters. This can be changed by adding *(int)* `HASHID_BINDING_MIN_LENGTH` to your environment file.

### Publishing the package config
By default all settings can be changed using environment variables. If you have the need to do this via a config file this is possible also. Simply run the following command:
`php artisan vendor:publish --tag"hashid-binding"` and make your changes there.
