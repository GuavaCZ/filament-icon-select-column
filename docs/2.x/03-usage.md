---
title: Usage
---

# Usage

## With an enum

The column works best with a backed enum. The enum should implement `HasLabel` and `HasIcon`, and can implement `HasColor`, as described in the [filament documentation](https://filamentphp.com/docs/4.x/components/enums):

```php
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;

$table->columns([
    IconSelectColumn::make('status')
        ->options(Status::class),
]);
```

## With arrays

Alternatively, you can pass the options and their icons directly to the column:

```php
IconSelectColumn::make('priority')
    ->options([
        'low' => 'Low',
        'high' => 'High',
    ])
    ->icons([
        'low' => 'heroicon-o-chevron-down',
        'high' => 'heroicon-o-chevron-up',
    ])
    ->colors([
        'low' => 'gray',
        'high' => 'danger',
    ]);
```

## Icon size

Use `size()` to change the icon size, either with filament's `IconSize` enum or its string value:

```php
IconSelectColumn::make('status')
    ->size('sm');
```

## Validation

The column only accepts values present in the options, so a manipulated request cannot write arbitrary values to the record.
