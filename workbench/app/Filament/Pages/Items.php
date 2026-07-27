<?php

namespace Workbench\App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Workbench\App\Enums\ItemStatus;
use Workbench\App\Models\Item;

/**
 * Exercises both flavours of the column: enum-backed options and a plain
 * options/icons array with `closeOnSelection()`.
 */
class Items extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Items';

    protected static ?string $title = 'Items';

    protected static ?string $slug = 'items';

    protected static ?int $navigationSort = 2;

    protected string $view = 'workbench::filament.pages.items';

    public function table(Table $table): Table
    {
        return $table
            ->query(Item::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                IconSelectColumn::make('status')
                    ->label('Status (enum)')
                    ->options(ItemStatus::class),
                IconSelectColumn::make('priority')
                    ->label('Priority (array, closes on selection)')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->icons([
                        'low' => 'heroicon-o-chevron-down',
                        'medium' => 'heroicon-o-minus',
                        'high' => 'heroicon-o-chevron-up',
                    ])
                    ->colors([
                        'low' => 'gray',
                        'medium' => 'warning',
                        'high' => 'danger',
                    ])
                    ->closeOnSelection(),
            ])
        ;
    }
}
