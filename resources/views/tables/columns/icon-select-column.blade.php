@php
    use Filament\Tables\Columns\IconColumn\IconColumnSize;

    $state = $getState();
    if ($state instanceof BackedEnum) {
        $state = $state->value;
    }
    $state = strval($state);

    $id = "{$this->getId()}.table.record.$recordKey.column.{$getName()}.icon-select-column";
@endphp

<div
    x-data="{
        error: undefined,

        isLoading: false,

        name: @js($getName()),

        recordKey: @js($recordKey),

        state: @js($state),
    }"
    x-init="
        () => {
            Livewire.hook('commit', ({ component, commit, succeed, fail, respond }) => {
                succeed(({ snapshot, effect }) => {
                    $nextTick(() => {
                        if (component.id !== @js($this->getId())) {
                            return
                        }

                        if (! $refs.newState) {
                            return
                        }

                        let newState = $refs.newState.value

                        if (state === newState) {
                            return
                        }

                        state = newState
                    })
                })
            })
        }
    "
    {{
        $attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-ta-icon flex gap-1.5',
                'flex-wrap' => $canWrap(),
                'px-3 py-4' => ! $isInline(),
                'flex-col' => $isListWithLineBreaks(),
            ])
    }}
    x-on:click.stop
>
    <input
        type="hidden"
        value="{{ str($state)->replace('"', '\\"') }}"
        x-ref="newState"
    />

    @if ($icon = $getIcon($state))
        @php
            $color = $getColor($state) ?? 'gray';
            $size = $getSize($state) ?? IconColumnSize::Large;
        @endphp
        <x-filament::dropdown placement="bottom-start"
                              teleport="body"
        >
            <x-slot name="trigger">
                <x-filament::loading-indicator
                    @class([
                        match ($size) {
                            IconColumnSize::ExtraSmall, 'xs' => 'fi-ta-icon-item-size-xs h-3 w-3',
                            IconColumnSize::Small, 'sm' => 'fi-ta-icon-item-size-sm h-4 w-4',
                            IconColumnSize::Medium, 'md' => 'fi-ta-icon-item-size-md h-5 w-5',
                            IconColumnSize::Large, 'lg' => 'fi-ta-icon-item-size-lg h-6 w-6',
                            IconColumnSize::ExtraLarge, 'xl' => 'fi-ta-icon-item-size-xl h-7 w-7',
                            IconColumnSize::TwoExtraLarge, IconColumnSize::ExtraExtraLarge, '2xl' => 'fi-ta-icon-item-size-2xl h-8 w-8',
                            default => $size,
                        },
                        match ($color) {
                            'gray' => 'text-gray-400 dark:text-gray-500',
                            default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                        },
                        is_string($color) ? 'fi-color-' . $color : null,
                    ])
                    @style([
                        \Filament\Support\get_color_css_variables(
                            $color,
                            shades: [400, 500],
                            alias: 'tables::columns.icon-select-column.item',
                        ) => $color !== 'gray',
                    ])
                    x-show="isLoading"
                />
                <x-filament::icon
                    x-show="! isLoading"
                    :icon="$icon"
                    @class([
                        'fi-ta-icon-item',
                        match ($size) {
                            IconColumnSize::ExtraSmall, 'xs' => 'fi-ta-icon-item-size-xs h-3 w-3',
                            IconColumnSize::Small, 'sm' => 'fi-ta-icon-item-size-sm h-4 w-4',
                            IconColumnSize::Medium, 'md' => 'fi-ta-icon-item-size-md h-5 w-5',
                            IconColumnSize::Large, 'lg' => 'fi-ta-icon-item-size-lg h-6 w-6',
                            IconColumnSize::ExtraLarge, 'xl' => 'fi-ta-icon-item-size-xl h-7 w-7',
                            IconColumnSize::TwoExtraLarge, IconColumnSize::ExtraExtraLarge, '2xl' => 'fi-ta-icon-item-size-2xl h-8 w-8',
                            default => $size,
                        },
                        match ($color) {
                            'gray' => 'text-gray-400 dark:text-gray-500',
                            default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                        },
                        is_string($color) ? 'fi-color-' . $color : null,
                    ])
                    @style([
                        \Filament\Support\get_color_css_variables(
                            $color,
                            shades: [400, 500],
                            alias: 'tables::columns.icon-select-column.item',
                        ) => $color !== 'gray',
                    ])
                />
            </x-slot>

            <x-filament::dropdown.list>
                @foreach ($getOptions() as $value => $label)
                    @php
                        $inputId = "{$id}-{$value}";
                        $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $label);
                    @endphp
                    <input
                        id="{{ $inputId }}"
                        name="{{ $id }}"
                        type="radio"
                        value="{{ $value }}"
                        wire:loading.attr="disabled"
                        x-model="state"
                        x-on:change="
                            isLoading = true

                            if (@js($shouldCloseOnSelection())) {
                                close()
                            }

                            const response = await $wire.updateTableColumnState(
                                name,
                                recordKey,
                                $event.target.value,
                            )

                            isLoading = false

                            error = response?.error ?? undefined

                            if (! error) {
                                state = response
                            }"
                        class="peer pointer-events-none absolute opacity-0"
                    />

                    <label for="{{$inputId}}" class="hover:cursor-pointer">
                        <x-filament::dropdown.list.item
                            @class([
                                'bg-gray-50 dark:bg-gray-800' => $value === $state,
                            ])
                            :icon="$getIcon($value)"
                            :icon-color="$getColor($value)"
                            tag="a"
                        >
                            {{ $label }}
                        </x-filament::dropdown.list.item>
                    </label>
                @endforeach
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    @elseif (($placeholder = $getPlaceholder()) !== null)
        <x-filament-tables::columns.placeholder>
            {{ $placeholder }}
        </x-filament-tables::columns.placeholder>
    @endif
</div>
