---
title: Usage
---

# Usage

## With an enum

The column works best with a backed enum. The enum should implement `HasLabel` and `HasIcon`, and can implement `HasColor`, as described in the [filament documentation](https://filamentphp.com/docs/3.x/support/enums):

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

## Close on selection

By default the dropdown stays open after a selection. To close it automatically, use `closeOnSelection()`:

```php
IconSelectColumn::make('status')
    ->closeOnSelection();
```

## Validation

The column only accepts values present in the options, so a manipulated request cannot write arbitrary values to the record.
