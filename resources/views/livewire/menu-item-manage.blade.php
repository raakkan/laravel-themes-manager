<div class="mt-4 flex w-full" x-data="menuItemsManager()">
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="w-2/6 bg-gray-200 p-2">
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
                    <template x-for="item in predefinedItems" :key="item.name">
                        <div class="relative group">
                            <div x-text="item.name"
                                class="block w-full text-left bg-gray-100 p-2 rounded group-hover:bg-gray-200 transition">
                            </div>
                            <button @click="addMenuItem(item.name);"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white text-xs p-1 rounded opacity-0 group-hover:opacity-100 transition">
                                Add
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <template x-if="menuItems.length > 0">
        <div class="w-4/6 bg-gray-100">
            <ul id="nested-sortable" class="max-w-full">
                <template x-for="(item, index) in menuItems" :key="index">
                    <li class="p-2 relative" draggable="true" @dragstart="dragStart($event, index)" @dragover.prevent
                        @drop="drop($event, index)">
                        <div x-text="item.name" class="bg-gray-200 p-2 rounded cursor-move"></div>
                        <div class="bg-gray-200 p-2 rounded" @dragover.prevent="dragover" @dragleave="dragleave"
                            @drop="dropAsChild($event, index)" :class="{ 'bg-blue-200': isDraggingOver }">
                            Drop here to add as child
                        </div>
                        <ul>
                            <template x-for="(child, childIndex) in item.children" :key="childIndex">
                                <li>
                                    <div x-text="child.name" class="bg-gray-200 p-2 rounded cursor-move"></div>
                                </li>
                            </template>
                        </ul>
                    </li>
                </template>
            </ul>
        </div>
    </template>

    <template x-if="menuItems.length === 0">
        <div class="w-4/6 bg-gray-100">
            <div class="p-4 max-w-full">
                {{ $menu->name }} no menu items
            </div>
        </div>
    </template>
</div>

@assets
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endassets

@script
    <script>
        Alpine.data('menuItemsManager', () => ({
            menuItems: @entangle('menuItems'),
            predefinedItems: [{
                    name: 'Home',
                    children: []
                },
                {
                    name: 'About',
                    children: []
                },
                {
                    name: 'Contact',
                    children: []
                },
                {
                    name: 'Services',
                    children: []
                }
            ],
            isDraggingOver: false,
            addMenuItem(itemName) {
                this.menuItems.push({
                    name: itemName,
                    children: []
                });
            },
            dragStart(event, index) {
                event.dataTransfer.setData('text/plain', index);
            },
            drop(event, targetIndex) {
                console.log('drop', this.menuItems);
                const sourceIndex = event.dataTransfer.getData('text/plain');
                const item = this.menuItems.splice(sourceIndex, 1)[0];
                this.menuItems.splice(targetIndex, 0, item);
            },
            dropAsChild(event, parentIndex) {
                console.log('dropAsChild', this.menuItems);

                const sourceIndex = event.dataTransfer.getData('text/plain');

                const item = this.menuItems.splice(sourceIndex, 1)[0];

                if (!this.menuItems[parentIndex].children) {
                    this.menuItems[parentIndex].children = [];
                }
                this.menuItems[parentIndex].children.push(item);
                this.isDraggingOver = false;
            },
            dragover() {
                this.isDraggingOver = true;
            },
            dragleave() {
                this.isDraggingOver = false;
            }
        }));
    </script>
@endscript
