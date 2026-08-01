<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-800">User Directory Sandbox (CRUD)</h3>
        
        <!-- Live Search Box -->
        <input wire:model.live="search" type="text" placeholder="Search users in real-time..." 
            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-1/3 text-sm">
    </div>

    <!-- Alert Messaging -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- LEFT COLUMN: CREATE/EDIT FORM -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 h-fit">
            <h4 class="font-semibold text-gray-700 mb-4">{{ $isEditMode ? 'Edit Profile' : 'Register New User' }}</h4>
            
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Full Name</label>
                    <input type="text" wire:model="name" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Email Address</label>
                    <input type="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex space-x-2 pt-2">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md text-sm transition shadow-sm">
                        {{ $isEditMode ? 'Update Account' : 'Save User' }}
                    </button>
                    
                    @if($isEditMode)
                        <button type="button" wire:click="resetInputFields" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md text-sm transition">
                            Cancel
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <!-- RIGHT COLUMN: DYNAMIC DATA TABLE -->
        <div class="md:col-span-2 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-gray-400">#{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2 font-medium">
                                <button wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-2 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $user->id }})" onclick="confirm('Are you sure you want to delete this sandbox record?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 bg-red-50 px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400">No users found matching your search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
