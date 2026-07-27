---
title: Upgrading
---

# Upgrading

This guide covers the upgrade from 1.x to 2.x. Version 2.x exists for filament 4.

The column was rewritten for filament 4: it now ships its own alpine component and renders through filament's dropdown.

## Upgrade filament

Please follow the [filament upgrade guide](https://filamentphp.com/docs/4.x/upgrade-guide) first.

## Bump the constraint

```bash
composer require guava/filament-icon-select-column:"^2.0"
```

## Publish the assets

The column now ships its own JS, so you need to publish the package assets:

```bash
php artisan filament:assets
```

## `closeOnSelection()` is unavailable

The rewrite dropped `closeOnSelection()`. If you rely on it, stay on 1.x or upgrade to 3.x (filament 5), where it is restored.
