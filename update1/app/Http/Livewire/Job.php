<?php

namespace App\Http\Livewire;

use Bsdev\Vacancy\Models\VacancyApplication;
use Livewire\Component;
use Livewire\WithFileUploads;

class Job extends Component
{
    use WithFileUploads;
    public $job;
    public $name;
    public $email;
    public $phone;
    public $cv;
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'cv' => 'required|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        ];
    }
    public function render()
    {
        return view('livewire.job');
    }
    public function apply()
    {
        $this->validate();
        VacancyApplication::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->email,
            'cv' => $this->cv->store('application', 'public'),
            'vacancy_id' => $this->job->id,
        ]);

        $this->alert('success', 'Successfully Applied!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);
        $this->name = null;
        $this->email = null;
        $this->phone = null;
        $this->cv = null;

    }
}
