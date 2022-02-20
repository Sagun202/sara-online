<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use FrontEndHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $name;
    public $email;
    public $phone;
    public $password;
    public $password_confirmation;
    public $currentRouteName;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'digits:10', 'unique:users'],
        ];
    }

    public function render()
    {
        return view('livewire.register');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function register()
    {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
        ]);

        $role = Role::firstOrCreate([
            'name' => 'user',
        ]);
        $user->assignRole($role);

        Auth::login($user);

        FrontEndHandler::transferProduct();

        if (auth()->user()->hasRole('user')) {
            if ($this->currentRouteName) {
                return redirect($this->currentRouteName);
            }
            return redirect(RouteServiceProvider::INDEX);

        }
        if ($this->currentRouteName) {
            return redirect($this->currentRouteName);
        }

        return redirect(RouteServiceProvider::HOME);
    }

}
