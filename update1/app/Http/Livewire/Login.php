<?php

namespace App\Http\Livewire;

use App\Providers\RouteServiceProvider;
use FrontEndHandler;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $currentRouteName;
    public $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6|string',
    ];
    public function render()
    {
        return view('livewire.login');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            FrontEndHandler::transferProduct();
            if (auth()->user()->hasRole('vendor')) {
                // if ($this->currentRouteName) {
                //     return redirect($this->currentRouteName);
                // }
                return redirect(RouteServiceProvider::VENDORDASHBOARD);

            }
            if (auth()->user()->hasRole('user')) {
                if ($this->currentRouteName) {
                    return redirect($this->currentRouteName);
                }
                return redirect(RouteServiceProvider::INDEX);

            }

            if ($this->currentRouteName) {
                return redirect($this->currentRouteName);
            }
            return redirect()->intended(RouteServiceProvider::HOME);

        } else {
            $this->addError('email', 'Invalid Credentials');
        }

    }
}
