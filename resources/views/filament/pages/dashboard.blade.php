<x-filament-panels::page>
    <!-- Emerald Welcome Banner -->
    <div class="mb-6 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-700 p-6 text-white shadow-lg">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0">
                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold">👋 Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="mt-1 text-emerald-100">Here's what's happening with your Technorics store today</p>
            </div>
        </div>
    </div>

    <x-filament-widgets::widgets
        :columns="$this->getColumns()"
        :data="
            [
                ...$this->getWidgetsData(),
            ]
        "
        :widgets="$this->getVisibleWidgets()"
    />
</x-filament-panels::page>
