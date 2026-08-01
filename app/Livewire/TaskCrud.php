<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

use Livewire\WithPagination;

class TaskCrud extends Component
{

     use WithPagination;
    // 🔴 These public properties must be defined here so the Blade file can see them!
    public $search = '';
    public $name = '';
    public $email = '';
    public $userId = null;
    public $isEditMode = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
    ];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(5); 

        return view('livewire.task-crud', [
            'users' => $users
        ]);
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            $user = User::find($this->userId);
            if ($user) {
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
                session()->flash('message', 'User updated successfully!');
            }
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt('password123'),
            ]);
            session()->flash('message', 'User created successfully!');
        }

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully!');
        }
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->userId = null;
        $this->isEditMode = false;
    }
}
