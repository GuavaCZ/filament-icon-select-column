---
title: Introduction
---

# Introduction

Icon Select Column adds an editable icon column to your filament tables. The cell renders the current state as an icon, and clicking it opens a dropdown where the user picks a new state, again represented by icons. The selection is saved straight to the record, like filament's own `SelectColumn`.

This is useful for quickly toggling states directly from a table, for example a status, a priority or a rating, without opening the edit page.

Add the column to any table:

```php
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;

IconSelectColumn::make('status')
    ->options(Status::class);
```

The column works best with a backed enum implementing filament's `HasLabel`, `HasIcon` and optionally `HasColor` contracts, but plain arrays work too. See [usage](03-usage) for both flavours.
