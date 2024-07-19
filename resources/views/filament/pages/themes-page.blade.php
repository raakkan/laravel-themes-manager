<x-filament::page>
    <div>
        <div class="mb-4">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search themes..."
                class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @php
                $themes = $this->filteredThemes();
                $activeTheme = $this->getActiveTheme();
            @endphp

            @foreach ($themes as $theme)
                <div class="bg-white shadow rounded-lg p-4 relative">
                    <div class="w-full h-40 bg-gray-200 mb-4 rounded flex items-center justify-center">
                        <span class="text-gray-500">No screenshot available</span>
                    </div>

                    <h3 class="text-lg font-semibold">{{ $theme->getName() }}</h3>
                    <p class="text-sm text-gray-600">{{ $theme->getDescription() }}</p>
                    <p class="text-xs text-gray-500 mt-2">Version: {{ $theme->getVersion() }}</p>

                    @if ($activeTheme && $theme->getName() === $activeTheme->getName())
                        <span
                            class="absolute top-2 right-2 bg-green-500 text-gray-400 text-xs font-bold px-2 py-1 rounded">Active</span>
                    @else
                        <button wire:click="activateTheme('{{ $theme->getName() }}', '{{ $theme->getVendor() }}')"
                            class="mt-4 bg-blue-500 hover:bg-blue-600 text-gray-400 font-bold py-2 px-4 rounded">
                            Activate
                        </button>
                    @endif
                </div>
            @endforeach
        </div>

        @if ($themes->isEmpty())
            <p class="text-center text-gray-500 mt-4">No themes found matching your search.</p>
        @endif
    </div>
</x-filament::page>
