<x-filament-panels::page>
    <x-filament::form wire:submit.prevent="save">
        {{ $this->form }}

        <x-filament::button type="submit">
            Submit
        </x-filament::button>
    </x-filament::form>
</x-filament-panels::page>
