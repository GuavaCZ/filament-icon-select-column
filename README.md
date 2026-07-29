![filament-icon-select-column Banner](https://github.com/GuavaCZ/filament-icon-select-column/raw/main/.github/banner.png)

# Icon Select Column for your filament tables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/guava/filament-icon-select-column.svg?style=flat-square)](https://packagist.org/packages/guava/filament-icon-select-column)
[![Total Downloads](https://img.shields.io/packagist/dt/guava/filament-icon-select-column.svg?style=flat-square)](https://packagist.org/packages/guava/filament-icon-select-column)

This plugin adds an editable icon column to your filament tables. The cell renders the current state as an icon, and clicking it opens a dropdown where the user picks a new state, again represented by icons. The selection is saved straight to the record, like filament's own `SelectColumn`.

This is useful for quickly toggling states directly from a table, for example a status, a priority or a rating, without opening the edit page.

## Documentation

The full documentation is available at [guava.cz](https://guava.cz/developers/packages/filament-icon-select-column?ref=github&utm_campaign=icon-select-column).

## Version compatibility

| Filament version | Plugin version |
|------------------|:--------------:|
| 3.x              |      1.x       |
| 4.x              |      2.x       |
| 5.x              |      3.x       |

For older filament versions, please check the branch of the respective version.

## Showcase

![Screenshot 1](https://github.com/GuavaCZ/filament-icon-select-column/raw/main/docs/images/screenshot_01.png)

## Installation

You can install the package via composer:

```bash
composer require guava/filament-icon-select-column
```

Next, publish the package assets:

```bash
php artisan filament:assets
```

Finally, make sure you have a **custom filament theme** (read [here](https://filamentphp.com/docs/5.x/styling/overview#creating-a-custom-theme) how to create one) and add the following to your **theme.css** file so the CSS is properly built:

```css
@source '../../../../vendor/guava/filament-icon-select-column/resources/**/*';
```

## Usage

Add the column to any table. It works best with a backed enum implementing `HasLabel`, `HasIcon` and optionally `HasColor`:

```php
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;

$table->columns([
    IconSelectColumn::make('status')
        ->options(Status::class),
]);
```

Everything else, including array options, icon sizes and closing the dropdown on selection, is covered in the [documentation](https://guava.cz/developers/packages/filament-icon-select-column?ref=github&utm_campaign=icon-select-column).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lukas Frey](https://github.com/lukas-frey)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
