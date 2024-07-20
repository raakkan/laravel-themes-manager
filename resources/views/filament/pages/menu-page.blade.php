<x-filament::page>
    <div class="p-4 bg-white rounded-lg shadow-md border">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold mb-2">Select Menu</h3>
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="selectedMenu">
                    <option value="">Select Menu</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>

            @if ($selectedMenu)
                {{ $this->editAction }}
            @endif
        </div>

        @if ($selectedMenu)
            @livewire('theme::livewire.menu-item-manage', ['menu' => $this->getSelectedMenu()])
        @endif
    </div>
</x-filament::page>
