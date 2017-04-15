<p align="center">
    <a href="https://travis-ci.org/rugaard/meta-scraper"><img src="https://travis-ci.org/rugaard/statsfc.svg?branch=master" alt="Build status"></a>
    <a href="https://codecov.io/gh/rugaard/meta-scraper"><img src="https://codecov.io/gh/rugaard/statsfc/branch/master/graph/badge.svg" alt="Codecov status"></a>
</p>

## 📝 Introduction

This package parses the API available through [StatsFC](http://statsfc.com).

[StatsFC](http://statsfc.com) is a service that exposes data about the biggest football leagues in Europe. You can i.e. get data about fixtures, squads, standings, top scorers and much more.

## ⚠️ Requirements

- PHP 7.1+
- cURL 7.19.4+ _(with OpenSSL and zlib)_ or make sure you enable `allow_url_fopen` in your systems `php.ini`

## 📦 Installation

The recommended way to install this package is through [Composer](https://getcomposer.org/), by using the following command:
```shell
composer require rugaard/statsfc
```

Alternatively, you can add the package by editing your projects existing `composer.json` file:
```json
 {
   "require": {
      "rugaard/statsfc": "~1.0"
   }
}
```

and then afterwards update [Composer](https://getcomposer.org/)s dependencies by using the following command:
```shell
composer update
```

### Laravel

If you're using the [Laravel](http://laravel.com) framework, this package comes with a out-of-the-box Service Provider. After the package has been installed, simply add the following line to the `config/app.php` in the `providers` array:
```php
'providers' => [
    Rugaard\StatsFC\Providers\LaravelServiceProvider::class,
]
```

After adding the `LaravelServiceProvider` class to the `config/app.php` file, run the following command in your terminal to publish the associated config file:
```shell
php artisan vendor:publish --provider="Rugaard\StatsFC\Providers\LaravelServiceProvider"
```

## ⚙️ Usage

TODO: Write instructions

## 🚓 License

StatsFC is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).