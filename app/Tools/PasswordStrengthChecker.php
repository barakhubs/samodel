<?php
namespace App\Tools;

class PasswordStrengthChecker {
    private $criteria;

    public function __construct() {
        $this->criteria = [
            'uppercase' => '/[A-Z]/',
            'lowercase' => '/[a-z]/',
            'number' => '/[0-9]/',
            'specialChar' => '/[!@#$%^&*()_+~`|}{[\]:;?><,.\/\\-=]/',
        ];
    }

    public function checkPasswordStrength($password) {
        $length = strlen($password);

        if ($length < 8) {
            return '<span class="text-danger">Your password is weak. Score is between (0-30%). Password is too short! Ensure that it contains at least one uppercase, one lowercase, one digit, and one special character.</span>';
        }

        $strengthPercentage = 0;

        foreach ($this->criteria as $name => $pattern) {
            if (preg_match($pattern, $password)) {
                $strengthPercentage += 25;
            }
        }

        return $this->getStrengthCategory($strengthPercentage);
    }

    private function getStrengthCategory($strengthPercentage) {
        $categories = [
            90 => '<span class="text-success">Your password is excellent. Score is between (90-100%)</span>',
            71 => '<span class="text-info">Your password is very good. Score is between (71-89%). Ensure that it contains at least one uppercase, one lowercase, one digit, and one special character.</span>',
            51 => '<span class="text-warning">Your password is good. Score is between (51-70%). Ensure that it contains at least one uppercase, one lowercase, one digit, and one special character.</span>',
            31 => '<span class="text-danger">Your password is weak. Score is between (31-50%). Ensure that it contains at least one uppercase, one lowercase, one digit, and one special character.</span>',
        ];

        foreach ($categories as $minPercentage => $category) {
            if ($strengthPercentage >= $minPercentage) {
                return $category;
            }
        }

        return '<span class="text-danger">Your password is very weak. Score is between (0-30%). Ensure that it contains at least one uppercase, one lowercase, one digit, and one special character.</span>';
    }
}
