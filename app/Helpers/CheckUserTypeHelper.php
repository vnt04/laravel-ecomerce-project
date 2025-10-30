<?php
namespace App\Helpers;

use App\Models\Customer;
use App\Models\User;

class CheckUserTypeHelper {
    public static function isUser($user) {
        return $user instanceof User;
    }

    public static function isCustomer($user) {
        return $user instanceof Customer;
    }
}