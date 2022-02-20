<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PersonalDetail extends Component
{
    public $name;
    public $email;
    public $phone;
    public $image;
    public $district;
    public $area;
    public $landmark;
    use WithFileUploads;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
            'phone' => ['required', 'digits:10', 'unique:users,phone,' . auth()->id()],
            'district' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'landmark' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,png,jpeg,gif,webp,svg', 'max:2048'],
            'address' =>['required', 'string', 'max:255'],
            'address2' => ['required', 'string', 'max:255'],
        ];
    }
    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->image = asset('storage/' . auth()->user()->image);
        // $this->image = auth()->user()->image;
        $this->district = auth()->user()->district;
        $this->area = auth()->user()->area;
        $this->landmark = auth()->user()->landmark;
        $this->address = auth()->user()->address;
        $this->address2 = auth()->user()->address2;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.personal-detail');
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->image) {
            $data['image'] = $this->image->store('users', 'public');
        }
        auth()->user()->update($data);
        $this->alert('success', 'Successfully Updated!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);
        return redirect()->route('user.dashboard');
    }
}
