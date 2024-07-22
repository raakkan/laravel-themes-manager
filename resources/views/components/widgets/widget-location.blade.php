@props(['location' => null])
<div x-data="{ open: false }">
    <div class="bg-gray-100 p-2 rounded-lg border ">
        <h3 class="text-base font-semibold">{{ $location['label'] }}</h3>

        <button @click="open = !open" class="flex items-center justify-between w-full bg-white px-3 py-2 rounded">
            <span>Select a menu item</span>
            <svg x-bind:class="{ 'rotate-180': open }" class="w-5 h-5 ml-2 transition-transform duration-200"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    </div>
</div>
