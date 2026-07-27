<?php

namespace Guava\FilamentIconSelectColumn;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentIconSelectColumnServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-icon-select-column';

    public static string $viewNamespace = 'guava-icon-select-column';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews(static::$viewNamespace)
        ;
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            [
                AlpineComponent::make(
                    'columns/icon-select',
                    __DIR__ . '/../dist/components/columns/icon-select.js'
                ),
            ],
            'guava/icon-select-column'
        );
    }
}
