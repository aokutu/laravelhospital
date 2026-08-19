<div>
    <div class="flex h-screen">

        <!-- LEFT SIDE - FORM (30%) -->
        <div class="w-3/10 bg-white border-r shadow-lg p-6" style="width:30%;">
            

            <h2 class="text-2xl font-bold mb-6">
                Customer Registration
            </h2>

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="saveCrowdworker">
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Name</label>
                    <input type="text" 
                           wire:model="name" 
                           class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Contact</label>
                    <input type="text" 
                           wire:model="contact" 
                           class="w-full border rounded p-2 @error('contact') border-red-500 @enderror">
                    @error('contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Email</label>
                    <input type="email" 
                           wire:model="email" 
                           class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Street</label>
                    <input type="text" 
                           wire:model="street" 
                           class="w-full border rounded p-2 @error('street') border-red-500 @enderror">
                    @error('street') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="submit" 
                            class="w-full p-3 rounded-lg bg-blue-600 text-white border border-blue-700 hover:bg-blue-700">
                        Save Customer
                    </button>
                </div>

                <button type="button" 
                        wire:click="resetForm" 
                        class="w-full mt-3 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 rounded-lg">
                    Reset
                </button>
            </form>

        </div>

        <!-- RIGHT SIDE - TABLE (70%) -->
        <div class="flex-1 p-6">

            <h2 class="text-2xl font-bold mb-6">
                Customer List 
                <span class="text-sm font-normal text-gray-500">
                   
                    (Total: {{ $crowdworkers->total() }})
                </span>
            </h2>

            <!-- Manual Refresh Button -->
            <button wire:click="$refresh" 
                    class="mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                🔄 Refresh Table
            </button>

            <!-- Loading indicator -->
            <span wire:loading class="text-blue-600 ml-3">
                ⏳ Loading...
            </span>

            <!-- Table with auto-refresh every 5 seconds >
            <div wire:poll.5s > 
                -->
            <div > 
                <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-blue-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">#</th>
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-left">Contact</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Street</th>
                             <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($crowdworkers as $index => $crowdworker)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} hover:bg-blue-100 transition-colors duration-200">
                                <td class="px-6 py-4"> {{ $crowdworkers->firstItem() + $index }}</td>
                                <td class="px-6 py-4">{{ $crowdworker['name'] }}</td>
                                <td class="px-6 py-4">{{ $crowdworker['contact'] }}</td>
                                <td class="px-6 py-4">{{ $crowdworker['email'] }}</td>
                                <td class="px-6 py-4">{{ $crowdworker['street'] }}</td>
                                <td class="px-6 py-4 text-center">
                    <button wire:click="edit({{ $crowdworker['id'] }})" class="text-blue-600 hover:text-blue-800 mr-3" title="Edit">  ✏️ </button>
                    <button wire:click="delete({{ $crowdworker['id'] }})" wire:confirm="Are you sure you want to delete this customer?" class="text-red-600 hover:text-red-800"  title="Delete">  🗑️ </button>
</td> </tr>
                        @empty
                            <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No crowdworkers found. Add your first crowdworker!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

               
   

            </div>

            <div class="mt-4">
    {{ $crowdworkers->links() }}
</div>

        </div>

    </div>
</div>