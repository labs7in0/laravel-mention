# Laravel Mention

A package to parse `@mentions` from a text and mention the user with a notification.

Special thanks to [David Dong](https://github.com/dongm2ez) and his [laravel-mention](https://github.com/dongm2ez/laravel-mention), and [Xetaravel-Mentions](https://github.com/XetaIO/Xetaravel-Mentions) from [XetaIO](https://github.com/XetaIO).

## Requirement

* PHP >= 5.6.0
* Laravel 5.x

## Installation

```shell
$ composer require labs7in0/larvel-mention
```

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

### For Laravel < 5.5

After installing the library, register the Service Provider in your `config/app.php` file:

```php
'providers' => [
    // ...
    Labs7in0\Mention\ServiceProvider::class,
    // ...
],
```

And the Facade:

```php
'aliases' => [
    // ...
    'Mention' => Labs7in0\Mention\Facade::class,
    // ...
],
```

### Configuration

As optional if you want to modify the default configuration, you can publish the configuration file:

```shell
$ php artisan vendor:publish --provider='Labs7in0\Mention\ServiceProvider' --tag="config"
```

```php
<?php

return [
    // Model that will be mentioned.
    'model' => App\User::class,

    // The column that will be used to search the model by the parser.
    'column' => 'name',

    // Match the front mentioned info
    'regex' => '/(\S*)\@([^\r\n\s]*)/i',

    // The route used to generate the user link.
    'route' => 'profile',

    // Output format, can be "html" or "markdown".
    'format' => 'markdown',

    // Notification class to use when the model is mentioned.
    // Leave null to disable notification.
    'notification' => App\Notifications\MentionNotification::class,
];
```

## Usage

```php
$parseText = Mention::parse("@david @Aaron @Judy @麦索 Balabalabala...");
```

## License

The MIT License

More info see [LICENSE](LICENSE)
