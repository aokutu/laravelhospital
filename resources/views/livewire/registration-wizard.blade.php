<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
    <h3 class="text-xl font-bold text-gray-800 mb-2">Multi-Step Wizard Pipeline</h3>
    <p class="text-xs text-gray-400 mb-6">Unified dataset execution mapping over multiple screen flows.</p>

    <!-- Progress Tracker Indicator Fill Bar -->
    <div class="w-full bg-gray-200 h-2 rounded-full mb-6 relative">
        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
        <div class="flex justify-between text-xs text-gray-500 mt-2">
            <span class="{{ $currentStep >= 1 ? 'text-blue-600 font-bold' : '' }}">1. Account Info</span>
            <span class="{{ $currentStep >= 2 ? 'text-blue-600 font-bold' : '' }}">2. Company Info</span>
            <span class="{{ $currentStep === 3 ? 'text-blue-600 font-bold' : '' }}">3. Finish</span>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">{{ session('message') }}</div>
    @endif

    <!-- Step 1 Interface View -->
    @if($currentStep === 1)
        <div class="space-y-4">
            <h4 class="font-semibold text-gray-700">Step 1: Account Credentials</h4>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Username</label>
                <input type="text" wire:model.blur="username" class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('username') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Password</label>
                <input type="password" wire:model.blur="password" class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    @endif

    <!-- Step 2 Interface View -->
    @if($currentStep === 2)
        <div class="space-y-4">
            <h4 class="font-semibold text-gray-700">Step 2: Business Profile</h4>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Company Name</label>
                <input type="text" wire:model.blur="company_name" class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('company_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Business Type</label>
                <select wire:model.blur="business_type" class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select option</option>
                    <option value="SaaS">Software / Tech</option>
                    <option value="Logistics">Logistics / Transport</option>
                    <option value="Retail">Retail Store</option>
                </select>
                @error('business_type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    @endif

    <!-- Step 3 Interface View -->
    @if($currentStep === 3)
        <div class="space-y-4">
            <h4 class="font-semibold text-gray-700">Step 3: Confirmation Summary</h4>
            <div class="p-4 bg-gray-50 rounded border text-sm text-gray-600 space-y-1">
                <p><strong>Username:</strong> {{ $username }}</p>
                <p><strong>Company:</strong> {{ $company_name }} ({{ $business_type }})</p>
            </div>
            <div class="flex items-start gap-2">
                <input type="checkbox" wire:model.blur="terms_accepted" id="terms" class="mt-1">
                <label for="terms" class="text-xs text-gray-600">I confirm that all summarized parameters are correct.</label>
            </div>
            @error('terms_accepted') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    @endif

    <!-- Flow Action Navigation Management Buttons -->
    <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-100">
        @if($currentStep > 1)
            <button type="button" wire:click="previousStep" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md text-sm transition">Back</button>
        @else
            <div></div> <!-- Layout placeholder balancing align hooks -->
        @endif

        @if($currentStep < $totalSteps)
            <button type="button" wire:click="nextStep" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md text-sm transition shadow-sm">Next</button>
        @else
            <button type="button" wire:click="submitForm" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-md text-sm transition shadow-sm">Submit Setup</button>
        @endif
    </div>
</div>
