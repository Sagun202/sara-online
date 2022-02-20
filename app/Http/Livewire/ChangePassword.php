<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $old_password;
    public $new_password;
    public $confirm_password;

    public function rules()
    {
        return [
            'old_password' => 'required|string|min:6|max:50',
            'new_password' => 'required|string|min:6|max:50',
            'confirm_password' => 'required|string|min:6|max:50',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.change-password');
    }

    public function save()
    {
        $this->validate();
        if (!Hash::check($this->old_password, auth()->user()->password)) {
            $this->addError('old_password', 'Old Password Doesnt match!!');
            return false;
        }
        if ($this->new_password != $this->confirm_password) {
            $this->addError('confirm_password', 'Password Confirm Doesnt Match!!');
            return false;
        }
        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);
        $this->alert('success', 'Successfully Updated!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);
        $this->old_password = "";
        $this->new_password = "";
        $this->confirm_password = "";

    }
}
