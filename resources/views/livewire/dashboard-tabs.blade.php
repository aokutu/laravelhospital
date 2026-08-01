<div class="flex flex-col md:flex-row gap-6 h-[calc(100vh-120px)] w-full">
    
    <!-- 🚀 Left Sidebar: Feature Navigation -->
    <aside class="w-full md:w-64 bg-slate-900 text-white rounded-lg p-4 flex flex-col gap-2 shadow-md h-full">
        <div class="p-3 border-b border-slate-700 mb-2">
            <h1 class="text-xl font-bold tracking-wide">⚡ Laravel Lab</h1>
            <p class="text-xs text-slate-400 mt-1">Feature Showcase Portal</p>
        </div>

        <button wire:click="switchTab('home')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'home' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>📊</span> Overview
        </button>

        <button wire:click="switchTab('features')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'features' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>🛠️</span> Livewire Modules
        </button>

        <button wire:click="switchTab('settings')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'settings' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>⚙️</span> App Config
        </button>
    </aside>

    <!-- 🖥️ Right Panel: Feature Sandbox -->
    <main class="flex-1 bg-white p-8 rounded-lg shadow-sm border border-gray-100 h-full flex flex-col">
        @if($activeTab === 'home')
            <div class="flex flex-col h-full">
                <h2 class="text-2xl font-bold text-gray-800">Application Overview</h2>
                <p class="text-gray-500 mt-1">A sandbox environment testing various Laravel core implementations.</p>
                <div class="mt-6 border-2 border-dashed border-gray-200 rounded-lg flex-1 flex items-center justify-center text-gray-400 bg-gray-50">
                    Main Dashboard Metrics & Project Status Go Here
                </div>
            </div>
        @elseif($activeTab === 'features')
            <div class="flex flex-col h-full">
                <h2 class="text-2xl font-bold text-gray-800">Livewire Component Sandbox</h2>
                <p class="text-gray-500 mt-1">Interactive states, components, and real-time operations.</p>
             

                <div class="mt-6 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
    <h3 class="text-lg font-semibold text-green-600">Hello from Localhost Sandbox!</h3>
    <p class="text-sm text-gray-500 mb-4">This change was written locally in VS Code.</p>
    <livewire:demo-counter />
</div>



        @elseif($activeTab === 'settings')
            <div class="flex flex-col h-full">
                <h2 class="text-2xl font-bold text-gray-800">Environment Preferences</h2>
                <p class="text-gray-500 mt-1">Manage localized component setups and debugging flags.</p>
                <div class="mt-6 border-2 border-dashed border-gray-200 rounded-lg flex-1 flex items-center justify-center text-gray-400 bg-gray-50">
                    Toggle Switches & Local Variables Go Here
                </div>
            </div>
        @endif
    </main>

</div>
