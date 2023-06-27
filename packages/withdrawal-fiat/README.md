# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sayedsoft/dex-withdrawalFiat.svg?style=flat-square)](https://packagist.org/packages/sayedsoft/dex-withdrawalFiat)
[![Total Downloads](https://img.shields.io/packagist/dt/sayedsoft/dex-withdrawalFiat.svg?style=flat-square)](https://packagist.org/packages/sayedsoft/dex-withdrawalFiat)
![GitHub Actions](https://github.com/sayedsoft/dex-withdrawalFiat/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require sayedsoft/dex-withdrawalFiat
```

## init

```php
php artisan migrate
```

### Use

```bash
     $save = new Withdraw($user_id,$wallet_id,$token_id,$amount);
    $save->validate();
    dd($save->save());

     $withdraw = withdrawalFiat::find(10);
     dd($withdraw->confirm());
     dd($withdraw->deny());
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email yemen@sayedsoft.com instead of using the issue tracker.

## Credits

-   [Ahmad Yaman Sayed](https://github.com/sayedsoft)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
