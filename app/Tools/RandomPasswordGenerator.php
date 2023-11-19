<?php
namespace App\Tools;

class RandomPasswordGenerator {
    public function generateRandomPassword() {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $digits = '0123456789';
        $specialChars = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';

        $password = '';

        // Ensure at least one character of each type
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $digits[random_int(0, strlen($digits) - 1)];
        $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

        $remainingLength = 16 - strlen($password);

        // Fill the remaining characters with a mix of all character types
        $allChars = $uppercase . $lowercase . $digits . $specialChars;
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        // Shuffle the password to ensure randomness
        $password = str_shuffle($password);

        return $password;
    }
}
