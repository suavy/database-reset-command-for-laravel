# Database Reset Command for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/suavy/database-reset-command-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/database-reset-command-for-laravel)
[![Build Status](https://img.shields.io/travis/suavy/database-reset-command-for-laravel/master.svg?style=flat-square)](https://travis-ci.org/suavy/database-reset-command-for-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/suavy/database-reset-command-for-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/suavy/database-reset-command-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/suavy/database-reset-command-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/database-reset-command-for-laravel)
[![StyleCI](https://github.styleci.io/repos/250306786/shield?branch=master)](https://github.styleci.io/repos/250306786)

This package reset your database in few steps : dropping, creating, importing (optional), migrating.

## Installation

You can install the package via composer:

``` bash
composer require suavy/database-reset-command-for-laravel
```

## Usage

``` bash
php artisan db:reset
```
### Options
#### --force (or --F)
Launch with no warning and no production protection
``` bash
php artisan db:reset --force
```
#### --import (or --I)
Import db.sql file located at root of your project (be sure to not commit this file, add it to your .gitignore)
``` bash
php artisan db:reset --import
```

## Contributing

Contributions are **welcome** and will be fully **credited**.

### Security

If you discover any security related issues, please email us instead of using the issue tracker.

## Credits

- [Suavy](https://github.com/suavy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
