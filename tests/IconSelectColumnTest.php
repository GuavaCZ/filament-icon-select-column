<?php

use Filament\Support\Enums\IconSize;
use Filament\Tables\Table;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Illuminate\Validation\Rules\In;
use Workbench\App\Enums\ItemStatus;
use Workbench\App\Filament\Pages\Items;

it('resolves options, icons and colors from a backed enum', function () {
    $column = IconSelectColumn::make('status')
        ->options(ItemStatus::class)
    ;

    expect($column->getOptions())->toBe([
        'draft' => 'Draft',
        'published' => 'Published',
        'archived' => 'Archived',
    ])
        ->and($column->getIcons())->toHaveKey('draft', 'heroicon-o-pencil')
        ->and($column->getColors())->toHaveKey('published', 'success')
    ;
});

it('accepts a plain options and icons array', function () {
    $column = IconSelectColumn::make('priority')
        ->options(['low' => 'Low', 'high' => 'High'])
        ->icons(['low' => 'heroicon-o-chevron-down', 'high' => 'heroicon-o-chevron-up'])
    ;

    expect($column->getOptions())->toBe(['low' => 'Low', 'high' => 'High'])
        ->and($column->getIcons())->toBe(['low' => 'heroicon-o-chevron-down', 'high' => 'heroicon-o-chevron-up'])
    ;
});

it('normalizes the icon size', function () {
    $column = IconSelectColumn::make('status');

    expect($column->getSize('draft'))->toBeNull();

    $column->size('sm');
    expect($column->getSize('draft'))->toBe(IconSize::Small);

    $column->size('base');
    expect($column->getSize('draft'))->toBeNull();
});

it('can be told to close the dropdown on selection', function () {
    $column = IconSelectColumn::make('status');

    expect($column->shouldCloseOnSelection())->toBeFalse()
        ->and($column->closeOnSelection()->shouldCloseOnSelection())->toBeTrue()
        ->and($column->closeOnSelection(fn (): bool => false)->shouldCloseOnSelection())->toBeFalse()
    ;
});

it('only validates values present in the options', function () {
    $column = IconSelectColumn::make('status')
        ->table(Table::make(new Items))
        ->options(ItemStatus::class)
    ;

    $rule = collect($column->getRules())
        ->first(fn ($rule): bool => $rule instanceof In)
    ;

    expect((string) $rule)->toBe('in:"draft","published","archived"');
});
