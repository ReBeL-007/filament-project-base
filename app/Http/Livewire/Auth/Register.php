<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Models\User;

use Illuminate\Support\Facades\Hash;


class Register extends Component
{
    public $name = 'ak';
    public $email = '';
    public $password = 'password';
    public $password_confirmation = 'password';

    public function register() 
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
