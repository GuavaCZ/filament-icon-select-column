<?php

namespace Guava\FilamentIconSelectColumn\Tables\Columns;

use Closure;
use Filament\Forms\Components\Concerns\HasColors;
use Filament\Forms\Components\Concerns\HasEnum;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeValidated;
use Filament\Tables\Columns\Concerns\CanUpdateState;
use Filament\Tables\Columns\Contracts\Editable;
use Illuminate\Validation\Rule;

class IconSelectColumn extends Column implements Editable
{
    use CanBeValidated {
        CanBeValidated::getRules as baseGetRules;
    }
    use CanUpdateState;
    use HasColors;
    use HasEnum;
    use HasIcons;
    use HasOptions;

    protected string $view = 'guava-icon-select-column::tables.columns.icon-select-column';

    protected IconSize | string | Closure | null $size = null;

    public function configure(): static
    {
        return $this
            ->disabledClick()
            ->alignCenter()
        ;
    }

    public function size(IconSize | string | Closure | null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(mixed $state): IconSize | string | null
    {
        $size = $this->evaluate($this->size, [
            'state' => $state,
        ]);

        if (blank($size)) {
            return null;
        }

        if ($size === 'base') {
            return null;
        }

        if (is_string($size)) {
            $size = IconSize::tryFrom($size) ?? $size;
        }

        return $size;
    }

    public function getRules(): array
    {
        return [
            ...$this->baseGetRules(),
            Rule::in(array_keys($this->getOptions())),
        ];
    }
}
