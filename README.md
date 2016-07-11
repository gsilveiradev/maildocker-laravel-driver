### Install

Require this package with composer using the following command:
```bash
composer require guissilveira/maildocker-laravel-driver
```

After updating composer, add the service provider to the `providers` array in `config/app.php`
```php
Guissilveira\MailDrivers\Maildocker\MaildockerServiceProvider::class,
```

You will also need to add the Maildocker API Key and API Secret settings to the array in `config/services.php` and set up the environment key
```php
'maildocker' => [
    'api_key' => env('MAILDOCKER_API_KEY'),
    'api_secret' => env('MAILDOCKER_API_SECRET'),
],
```
```bash
MAILDOCKER_API_KEY=__Your_api_key_here__
MAILDOCKER_API_SECRET=__Your_api_secret_here__
```

Finally you need to set your mail driver to `maildocker`. You can do this by changing the driver in `config/mail.php`
```php
'driver' => env('MAIL_DRIVER', 'maildocker'),
```

Or by setting the environment variable `MAIL_DRIVER` in your .env file
```bash
MAIL_DRIVER=maildocker
```


If you need to pass any options to the guzzle client instance which is making the request to the Maildocker API, you can do so by setting the 'guzzle' options in `config/services.php`
```php
'maildocker' => [
    'api_key' => env('MAILDOCKER_API_KEY'),
    'api_secret' => env('MAILDOCKER_API_SECRET'),
    'guzzle' => [
        'verify' => true,
        'decode_content' => true,
    ]
],
```
