---
title: Upgrading
---

# Upgrading

This guide covers the upgrade from 2.x to 3.x. Version 3.x exists for filament 5.

There are no changes to the column's API, so the upgrade is a matter of upgrading filament itself.

## Upgrade filament

Please follow the [filament upgrade guide](https://filamentphp.com/docs/5.x/upgrade-guide) first.

## Bump the constraint

```bash
composer require guava/filament-icon-select-column:"^3.0"
```

## `closeOnSelection()` is back

Version 3.0.1 restores `closeOnSelection()`, which was lost in the 2.x rewrite. If you removed it during the 1.x to 2.x upgrade, you can add it back.
