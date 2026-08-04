<div class="flex flex-col md:flex-row gap-6 h-[calc(100vh-120px)] w-full">
    
    <!-- 🚀 Left Sidebar: Feature Navigation -->
    <aside class="w-full md:w-64 bg-slate-900 text-white rounded-lg p-4 flex flex-col gap-2 shadow-md h-full">
        <div class="p-3 border-b border-slate-700 mb-2">
            <h1 class="text-xl font-bold tracking-wide">⚡ Laravel Lab</h1>
            <p class="text-xs text-slate-400 mt-1">Feature Showcase Portal</p>
        </div>

        <!-- RESTORED: Overview / Home Button -->
        <button wire:click="switchTab('home')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'home' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>📊</span> Overview
        </button>

        <!-- Wizard Form Button -->
        <button wire:click="switchTab('wizard')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'wizard' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span></span> Wizard Form :> 📑 PDF
        </button>

        <!-- Crud Livewire Button -->
        <button wire:click="switchTab('features')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'features' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>🛠️</span> Crud_Livewire
        </button>

        <!-- App Config Button -->
        <button wire:click="switchTab('settings')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'settings' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>⚙️</span> App Config
        </button>
    </aside>

    <!-- 🖥️ Right Panel: Feature Sandbox -->
    <main class="flex-1 bg-white p-8 rounded-lg shadow-sm border border-gray-100 h-full flex flex-col overflow-y-auto">
        
        <!-- 1. HOME TAB PANEL -->
        @if($activeTab === 'home')
            <div class="flex flex-col h-full">
                <h2 class="text-2xl font-bold text-gray-800">Application Overview</h2>
                <p class="text-gray-500 mt-1">A sandbox environment testing various Laravel core implementations.</p>
                <div class="mt-6 border-2 border-dashed border-gray-200 rounded-lg flex-1 flex items-center justify-center text-gray-400 bg-gray-50">
                    Main Dashboard Metrics & Project Status Go Here
                </div>
            </div>

        <!-- 2. FIXED: ADDED WIZARD TAB PANEL CONDITIONAL -->
        @elseif($activeTab === 'wizard')
            <div class="flex flex-col h-full">
                <livewire:registration-wizard />
            </div>

        <!-- 3. FEATURES TAB PANEL (DUAL CRUD) -->
        @elseif($activeTab === 'features')
            <div class="flex flex-col h-full">
                <h2 class="text-2xl font-bold text-gray-800"> <strong>💡 Laravel CRUD & PAGINATION Implementation Proof:</strong> </h2>
                <div class="mb-6 p-4 bg-indigo-50 border-l-4 border-indigo-500 rounded-r-lg text-sm text-indigo-900">
                    This module demonstrates real-time asynchronous CRUD operations using <br> 
                    Laravel Livewire. It features automated server-side request validation, stateless query pagination, <br>
                    and reactive UI component morphing via background AJAX requests—completely eliminating page reloads.
                </div>
             
                <div class="mt-6">
                    <livewire:task-crud />
                </div>

                <div class="mt-6">
                    <livewire:lead-manager />
                </div>
            </div>

        <!-- 4. SETTINGS TAB PANEL -->
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
