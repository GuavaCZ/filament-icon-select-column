<?php

namespace Guava\FilamentIconSelectColumn\Tables\Columns;

use BackedEnum;
use Filament\Forms\Components\Concerns\HasColors;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Tables\Columns\Concerns\CanBeValidated;
use Filament\Tables\Columns\Concerns\CanUpdateState;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Validation\Rule;

class IconSelectColumn extends IconColumn implements Editable
{
    use CanBeValidated {
        CanBeValidated::getRules as baseGetRules;
    }
    use CanUpdateState;
    use HasColors {
        HasColors::getColor as baseGetColor;
    }
    use HasIcons {
        HasIcons::getIcon as baseGetIcon;
    }
    use HasOptions;

    protected string $view = 'guava-icon-select-column::tables.columns.icon-select-column';

    public function getIcon(mixed $value): ?string
    {
        if ($value instanceof BackedEnum) {
            $value = $value?->value ?? $value->name;
        }

        return $this->baseGetIcon($value);
    }

    public function getColor(mixed $value): string | array | null
    {
        if ($value instanceof BackedEnum) {
            $value = $value?->value ?? $value->name;
        }

        return $this->baseGetColor($value);
    }

    public function getRules(): array
    {
        return [
            ...$this->baseGetRules(),
            Rule::in(array_keys($this->getOptions())),
        ];
    }
}
