<?php

namespace Guava\FilamentIconSelectColumn;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentIconSelectColumnServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('guava-icon-select-column')
            ->hasViews()
        ;
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            [
                AlpineComponent::make(
                    'columns/icon-select',
                    __DIR__ . '/../resources/js/dist/components/columns/icon-select.js'
                ),
            ],
            'guava/icon-select-column'
        );
    }
}
