@php
    use Filament\Support\Enums\Alignment;
    use Filament\Support\Facades\FilamentAsset;
    use Filament\Support\Facades\FilamentView;
    use Illuminate\Support\Js;
    use Illuminate\View\ComponentAttributeBag;
    use Filament\Schemas\View\Components\IconComponent;

    use function Filament\Support\generate_icon_html;
    use function Filament\Support\generate_loading_indicator_html;

    $state = $getState();
    if ($state instanceof BackedEnum) {
        $state = $state->value;
    }
    $state = strval($state);

    $icon = $getIcon($state);
    $color = $getColor($state);
    $size = $getSize($state);

    $alignment = $getAlignment();
@endphp

<div
    {{ $getExtraAttributeBag()
        ->merge([
            'x-load' => FilamentView::hasSpaMode()
                ? 'visible || event (x-modal-opened)'
                : true,
            'x-load-src' => FilamentAsset::getAlpineComponentSrc('columns/icon-select', 'guava/icon-select-column'),
            'x-data' => 'iconSelectTableColumn({
                name: ' . Js::from($column->getName()) . ',
                recordKey: ' . Js::from($column->getRecordKey()) . ',
                state: ' . Js::from($state) . ',
            })',
        ], escape: false)
        ->class([
            'w-full flex',
            match ($alignment) {
                Alignment::Start, Alignment::Left => 'justify-start',
                Alignment::End, Alignment::Right => 'justify-end',
                Alignment::Center => 'justify-center',
                default => 'justify-center',
            }
        ])
}}>

    <input type="hidden" value="<?= $state ?>" x-ref="serverState"/>

    <x-filament::dropdown
        x-bind:style="`--gu-isc-offset: ${offset}px`"
        class="[&_.fi-dropdown-panel]:translate-x-[var(--gu-isc-offset)]"
        teleport="body"
        placement="bottom-start">
        <x-slot name="trigger"
                x-on:mouseover="if (modal != null) { offset = modal.getBoundingClientRect().left }"
        >
            <span x-show="isLoading" x-cloak>
                {{ generate_loading_indicator_html(
                    attributes: (new ComponentAttributeBag)
                        ->merge([
                            'class' => 'text-gray-500',
                        ]),
                    size: $size
                ) }}
            </span>
            <span x-show="!isLoading">
                {{
                    generate_icon_html(
                        $icon,
                        attributes: (new ComponentAttributeBag)
                            ->color(IconComponent::class, $color)
                            ->merge([
                                'class' => 'text-color-500',
                            ]),
                        size: $size,
                    )
                }}
            </span>
        </x-slot>

        <x-filament::dropdown.list>
            @foreach($getOptions() as $key => $label)
                @php
                    $icon = $getIcon($key);
                    $color = $getColor($key);
                    $size = $getSize($key);
                @endphp

                <x-filament::dropdown.list.item :icon="$icon"
                                                :icon-color="$color"
                                                :icon-size="$size"
                                                x-on:click.prevent="state = '{{$key}}'"
                >
                    {{$label}}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
