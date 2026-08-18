<div class="p-6 max-w-sm bg-white dark:bg-zinc-900 rounded-lg shadow border border-zinc-200 dark:border-zinc-800">
    <h2 class="text-lg font-bold mb-4 text-zinc-950 dark:text-zinc-50">DARAJA STK PUSH </h2>

    <form wire:submit.prevent="processForm" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-1 text-zinc-700 dark:text-zinc-300">Phone Number</label>
            <input type="text" wire:model="phone" placeholder="e.g. 0711487030" 
                   class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 p-2 text-sm bg-transparent text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled"
                class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-semibold transition-colors disabled:opacity-50">
            <span wire:loading.remove>Submit Phone</span>
            <span wire:loading>Capturing via Livewire...</span>
        </button>
    </form>

    <!-- Async API feedback banner -->
    @if($status)
        <div class="mt-4 p-3 rounded text-sm @if($status === 'success') bg-green-100 text-green-800 dark:bg-green-950/40 dark:text-green-400 @elseif($status === 'loading') bg-blue-100 text-blue-800 dark:bg-blue-950/40 dark:text-blue-400 @else bg-red-100 text-red-800 dark:bg-red-950/40 dark:text-red-400 @endif">
            {{ $message }}
        </div>
    @endif

<!--  DEV DEMO GATEWAY SIMULATOR TOOL -->
<div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800">
    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Dev Simulation Console</p>
    <button wire:click="simulateIncomingPayment" 
            class="w-full py-1.5 px-3 bg-zinc-100 hover:bg-zinc-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded text-xs font-mono transition-colors border border-zinc-200 dark:border-zinc-700 flex justify-between items-center">
        <span>⚡ Mock Customer Checkout</span>
        <span class="text-[10px] opacity-60">Simulate C2B</span>
    </button>
</div>

</div>
