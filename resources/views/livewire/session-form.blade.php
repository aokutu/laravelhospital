<div class="w-full max-w-xl mx-auto p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
    
    @if(!session()->has('first_name'))
        <!-- STATE A: Form view loaded from this file -->
        <h2 class="text-xl font-bold text-gray-800 mb-4">Enter Details</h2>
        
        <form wire:submit="submitForm" class="space-y-4">
            <!-- First Name Field -->
            <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" id="firstName" wire:model="firstName" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('firstName') border-red-500 @enderror">
                @error('firstName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Second Name Field -->
            <div>
                <label for="secondName" class="block text-sm font-medium text-gray-700 mb-1">Second Name</label>
                <input type="text" id="secondName" wire:model="secondName" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('secondName') border-red-500 @enderror">
                @error('secondName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                Submit Data & Switch Tab
            </button>
        </form>

    @else
        <!-- STATE B: Display results card loaded dynamically within this same file -->
        <div class="space-y-4">
            <h3 class="text-green-700 font-bold text-lg flex items-center gap-2">
                <span>⚡</span> Live Session Data
            </h3>
            
            <div class="text-sm space-y-2 bg-gray-50 border border-gray-100 rounded-md p-4">
                <p class="text-gray-600"><strong>First Name:</strong> <span class="bg-white px-2 py-1 rounded border ml-2 text-gray-900 font-mono">{{ session('first_name') }}</span></p>
                <p class="text-gray-600"><strong>Second Name:</strong> <span class="bg-white px-2 py-1 rounded border ml-2 text-gray-900 font-mono">{{ session('second_name') }}</span></p>
            </div>
    <!-- FIXED LINK: Resets the component view directly without reloading the web page -->
    <button type="button" 
            wire:click="$set('firstName', ''); $set('secondName', ''); {{ session()->forget(['first_name', 'second_name']) }}" 
            class="text-xs text-red-600 hover:text-red-700 hover:underline font-medium mt-2 block transition">
        Clear Stored Names & Retest
    </button>
        </div>
    @endif

</div>
