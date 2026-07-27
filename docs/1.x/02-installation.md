---
title: Installation
---

# Installation

## Requirements

- PHP 8.1 or higher
- Filament 3.x

## Installing the package

You can install the package via composer:

```bash
composer require guava/filament-icon-select-column:"^1.0"
```

## Custom theme

A custom filament theme is **required**, otherwise the CSS of the column is not built and the dropdown will look broken.

If you don't have one yet, please read the [filament documentation](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) on how to create a custom theme.

Once you have a theme, add the following to your **theme.css** file:

```css
@source '../../../../vendor/guava/filament-icon-select-column/resources/**/*';
```
