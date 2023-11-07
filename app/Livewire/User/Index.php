<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    public $name;
    public $email;
    public $password;
    public $image;
    public $search;
    use WithFileUploads;
    use WithPagination;

    public function create()
    {
        $data = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'image' => 'required|max:1028',
        ]);

        User::create($data);
        $this->reset();
        session()->flash('success', 'Success created!');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('success', 'Success deleted!');
    }

    public function edit(){
        
    }

    public function render()
    {
        return view('livewire.user.index', [
            'users' => User::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
