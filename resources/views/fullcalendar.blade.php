@php
    $plugin = \Saade\FilamentFullCalendar\FilamentFullCalendarPlugin::get();
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex justify-end flex-1 mb-4">
            <x-filament-actions::actions :actions="$this->getCachedHeaderActions()" class="shrink-0" />
        </div>

        <div class="filament-fullcalendar" wire:ignore ax-load
            ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-fullcalendar-alpine', 'saade/filament-fullcalendar') }}"
            ax-load-css="{{ \Filament\Support\Facades\FilamentAsset::getStyleHref('filament-fullcalendar-styles', 'saade/filament-fullcalendar') }}"
            x-ignore x-data="fullcalendar({
                locale: @js($plugin->getLocale()),
                plugins: @js($plugin->getPlugins()),
                schedulerLicenseKey: @js($plugin->getSchedulerLicenseKey()),
                timeZone: @js($plugin->getTimezone()),
                editable: @json($plugin->isEditable()),
                selectable: @json($plugin->isSelectable()),
                eventClassNames: {!! htmlspecialchars($this->eventClassNames(), ENT_COMPAT) !!},
                eventContent: {!! htmlspecialchars($this->eventContent(), ENT_COMPAT) !!},
                eventDidMount: {!! htmlspecialchars($this->eventDidMount(), ENT_COMPAT) !!},
                eventWillUnmount: {!! htmlspecialchars($this->eventWillUnmount(), ENT_COMPAT) !!},
                resourceLabelClassNames: {!! htmlspecialchars($this->resourceLabelClassNames(), ENT_COMPAT) !!},
                resourceLabelContent: {!! htmlspecialchars($this->resourceLabelContent(), ENT_COMPAT) !!},
                resourceLabelDidMount: {!! htmlspecialchars($this->resourceLabelDidMount(), ENT_COMPAT) !!},
                resourceLabelWillUnmount: {!! htmlspecialchars($this->resourceLabelWillUnmount(), ENT_COMPAT) !!},
                resourceLaneClassNames: {!! htmlspecialchars($this->resourceLaneClassNames(), ENT_COMPAT) !!},
                resourceLaneContent: {!! htmlspecialchars($this->resourceLaneContent(), ENT_COMPAT) !!},
                resourceLaneDidMount: {!! htmlspecialchars($this->resourceLaneDidMount(), ENT_COMPAT) !!},
                resourceLaneWillUnmount: {!! htmlspecialchars($this->resourceLaneWillUnmount(), ENT_COMPAT) !!},
                config: @processJsConfig($this->getConfig())
            })">
        </div>
    </x-filament::section>

    <x-filament-actions::modals />
</x-filament-widgets::widget>
