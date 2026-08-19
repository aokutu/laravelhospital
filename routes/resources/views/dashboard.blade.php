<x-app-layout>
    <!-- Mount Livewire CSS assets -->
    @livewireStyles 

    <div class="w-full px-4 py-6 md:px-8">
        <!-- Keep only this single tag here. It calls the Livewire component safely -->
        <livewire:dashboard-tabs />
    </div>

    <!-- Mount Livewire JS assets -->
    @livewireScripts 
</x-app-layout>
