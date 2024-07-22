<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold mb-4">Manage Widgets</h2>
            <div class="space-y-4">
                @forelse ($themeWidgetLocations as $location)
                    <x-themes-manager::widgets.widget-location :location="$location" />
                @empty
                    <div>No widget locations available</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
