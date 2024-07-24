<div class="mt-4 flex w-full">
    {{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/css/base.css', 'resources/js/menu.ts']) }}
    <div class="w-2/6 bg-gray-100 p-2 border-r border-gray-200">
        <div class="w-full max-w-full">
            <div x-data="{ open: false }" class="w-full bg-white rounded">
                <button @click="open = !open" class="flex items-center justify-between w-full bg-white px-3 py-2 rounded">
                    <span>Select a menu item</span>
                    <svg x-bind:class="{ 'rotate-180': open }" class="w-5 h-5 ml-2 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="space-y-2 px-3 pb-3">
                    @foreach ($this->getMenuItems() as $item)
                        <div class="relative group">
                            <div
                                class="block w-full text-left bg-gray-100 p-2 rounded group-hover:bg-gray-200 transition">
                                {{ $item->getName() }}
                            </div>
                            <div
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 opacity-0 group-hover:opacity-100 transition">
                                <button wire:click="addMenuItem({{ json_encode($item->toArray()) }})"
                                    class="bg-blue-500 text-white text-xs p-2 rounded mr-1">
                                    Add
                                </button>
                                @if ($selectedItem && isset($selectedItem['id']))
                                    <button wire:click="addAsChild({{ json_encode($item->toArray()) }})"
                                        class="bg-green-500 text-white text-xs p-2 rounded">
                                        Add as child
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if (count($menuItems) > 0)
        <div class="w-4/6 bg-gray-100 p-2" x-data="{
            handle: (item, position) => {
                $wire.updateMenuItemOrder(item, position)
            }
        }">
            <ul id="nested-sortable" x-sort="handle" class="max-w-full">
                @foreach ($menuItems as $index => $item)
                    <x-themes-manager::menu.menu-item :item="$item" :selected-item="$selectedItem" />
                @endforeach
            </ul>
        </div>
    @else
        <div class="w-4/6 bg-gray-100">
            <div class="p-4 max-w-full h-40 flex items-center justify-center">
                <span><b>{{ $menu->name }}</b> has no menu items</span>
            </div>
        </div>
    @endif
</div>
