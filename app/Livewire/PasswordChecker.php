<?php

namespace App\Livewire;

use App\Tools\PasswordStrengthChecker;
use Livewire\Component;

class PasswordChecker extends Component
{
    public $feedback;
    public $password;

    protected $rules = [
        'password' => 'required',
    ];
    public function submit()
    {
        $this->validate();

        $passwordChecker = new PasswordStrengthChecker();
        $passwordStrength = $passwordChecker->checkPasswordStrength($this->password);
        $this->feedback = $passwordStrength;

    }

    public function render()
    {
        return view('livewire.password-checker');
    }
}
