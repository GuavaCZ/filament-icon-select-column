![Filament Icon Select Column Banner](https://github.com/GuavaCZ/filament-icon-select-column/raw/main/docs/images/banner.jpg)


# Adds a icon select (via dropdown) column to your filament tables.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/guava/filament-icon-select-column.svg?style=flat-square)](https://packagist.org/packages/guava/filament-icon-select-column)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/guavaCZ/filament-icon-select-column/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/guavaCZ/filament-icon-select-column/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/GuavaCZ/filament-icon-select-column/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/GuavaCZ/filament-icon-select-column/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/guava/filament-icon-select-column.svg?style=flat-square)](https://packagist.org/packages/guava/filament-icon-select-column)

This plugin adds an Icon Select Column to your filament tables.

## Showcase

<video width="320" height="240" controls>
  <source src="https://github.com/GuavaCZ/filament-icon-select-column/raw/main/docs/images/demo_preview.mp4" type="video/mp4">
</video>

![Screenshot 1](https://github.com/GuavaCZ/filament-icon-select-column/raw/main/docs/images/screenshot_01.png)

## Support us

Your support is key to the continual advancement of our plugin. We appreciate every user who has contributed to our journey so far.

While our plugin is available for all to use, if you are utilizing it for commercial purposes and believe it adds significant value to your business, we kindly ask you to consider supporting us through GitHub Sponsors. This sponsorship will assist us in continuous development and maintenance to keep our plugin robust and up-to-date. Any amount you contribute will greatly help towards reaching our goals. Join us in making this plugin even better and driving further innovation.

## Installation

You can install the package via composer:

```bash
composer require guava/filament-icon-select-column
```

## Usage

In any filament table, simply use it like any other column.

The package works best in combination with backed enums, such as in the below example.

The enum should implement `HasLabel`, `HasIcon` and optionally `HasColor` as described in the filament documentation [here](https://filamentphp.com/docs/3.x/support/enums).

```php
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;

$table->columns([
    IconSelectColumn::make('state')
        ->options(MyStateEnum::class)
]);
```

Alternatively, you can pass an array of options and icons directly to the column:

```php
$table->columns([
    IconSelectColumn::make('state')
        ->options([
            'opt1' => 'Option 1',
            'opt2' => 'Option 2',
        ])
        ->icons([
            'opt1' => 'heroicon-o-check',
            'opt2' => 'heroicon-o-x-mark',
        ])
]);
````

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lukas Frey](https://github.com/GuavaCZ)
- [All Contributors](../../contributors)
- Spatie - Our package skeleton is a modified version of [Spatie's Package Skeleton](https://github.com/spatie/package-skeleton-laravel)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
