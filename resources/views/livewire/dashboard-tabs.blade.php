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


        <button wire:click="switchTab('uploads')" 
            class="w-full text-left px-4 py-3 rounded-md transition-all flex items-center gap-3 font-medium {{ $activeTab === 'uploads' ? 'bg-blue-600 text-white shadow' : 'text-slate-300 hover:bg-slate-800' }}">
            <span>🛠️</span> Files Upload 
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


         @elseif($activeTab === 'uploads')
            <div class="flex flex-col h-full">
                UPLOADS
                 <div class="flex flex-col h-full p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload Internal Document</h2>

    <!-- Success Feedback Container -->
    @if (session()->has('message'))
        <div class="p-3 mb-4 text-sm text-green-800 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <!-- Single File Input Form Element -->
    <form wire:submit.prevent="saveFile" class="space-y-4">
        <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gray-50 hover:bg-gray-100 transition">
            
            <!-- Standard Input file element bound to Livewire property -->
            <input type="file" wire:model="uploadedFile" id="file-upload" class="sr-only">
            
            <label for="file-upload" class="cursor-pointer flex flex-col items-center space-y-2">
                <!-- Document Vector SVG Icon -->
                <svg xmlns="http://w3.org" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span class="text-sm font-medium text-blue-600 underline">Select a document file</span>
                <span class="text-xs text-gray-500">PDF, DOCX, or TXT up to 10MB</span>
            </label>

            <!-- Livewire Loading State Display Indicator Layer -->
            <div wire:loading wire:target="uploadedFile" class="mt-2 text-xs text-blue-500 font-medium">
                🔄 Processing and staging file...
            </div>

            <!-- Display the staged file name if selected -->
            @if ($uploadedFile)
                <div class="mt-3 text-xs text-gray-600 bg-blue-50 px-2 py-1 rounded border border-blue-200">
                    📄 Selected: <strong>{{ $uploadedFile->getClientOriginalName() }}</strong>
                </div>
            @endif

            <!-- Catch Validation Rule Breaks -->
            @error('uploadedFile') 
                <span class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Submission Execution Trigger Button Layer -->
        <button type="submit" 
                wire:loading.attr="disabled"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow transition flex items-center justify-center gap-2 disabled:opacity-50">
            <span wire:loading.remove wire:target="saveFile">🚀 Upload Document File</span>
            <span wire:loading wire:target="saveFile">⚡ Saving to storage...</span>
        </button>
    </form>
</div>

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
