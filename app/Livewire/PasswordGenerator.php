<?php

namespace App\Livewire;

use App\Tools\RandomPasswordGenerator;
use Livewire\Component;

class PasswordGenerator extends Component
{
    public $feedback = "";
    public function generatePassword()
    {
        // Usage:
        $passwordGenerator = new RandomPasswordGenerator();
        $randomPassword = $passwordGenerator->generateRandomPassword();
        $this->feedback = $randomPassword;

    }

    public function render()
    {
        return view('livewire.password-generator');
    }
}
