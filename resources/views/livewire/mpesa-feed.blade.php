<div wire:poll.3s class="p-6 max-w-md mx-auto bg-white dark:bg-zinc-900 rounded-xl shadow border border-zinc-200 dark:border-zinc-800">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-base font-bold text-zinc-950 dark:text-zinc-50">Live Till Monitor</h2>
        <span class="flex h-2 w-2 relative">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
        </span>
    </div>

    <div class="space-y-3">
        @forelse($transactions as $tx)
            <div class="p-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg border border-zinc-100 dark:border-zinc-800/80 flex justify-between items-center transition-all animate-fade-in">
                <div>
                    <p class="font-bold text-sm text-zinc-900 dark:text-zinc-100">
                        {{ $tx->first_name }} {{ $tx->last_name }}
                    </p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                        Code: <span class="font-mono font-semibold uppercase text-indigo-600 dark:text-indigo-400">{{ $tx->mpesa_code }}</span>
                    </p>
                    <p class="text-[10px] text-zinc-400 dark:text-zinc-500">
                        Phone: +{{ $tx->phone }} • Ref: {{ $tx->bill_ref }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                        KES {{ number_format($tx->amount, 2) }}
                    </p>
                    <p class="text-[10px] text-zinc-400">{{ $tx->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p class="text-xs text-zinc-500 text-center py-6">Waiting for incoming retail payments...</p>
        @endforelse
    </div>
</div>
