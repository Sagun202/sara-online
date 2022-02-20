<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use FrontEndHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class VendorRegister extends Component
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public function render()
    {
        return view('livewire.vendor-register');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:20',
        ];
    }
    public function save()
    {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
        ]);

        $role = Role::firstOrCreate([
            'name' => 'vendor',
        ]);
        $user->assignRole($role);

        Auth::login($user);

        FrontEndHandler::transferProduct();

        if (auth()->user()->hasRole('vendor')) {
            // if ($this->currentRouteName) {
            //     return redirect($this->currentRouteName);
            // }
            return redirect(RouteServiceProvider::VENDORDASHBOARD);

        }
        // if ($this->currentRouteName) {
        //     return redirect($this->currentRouteName);
        // }

        return redirect(RouteServiceProvider::VENDORDASHBOARD);
    }
}
