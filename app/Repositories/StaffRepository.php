<?php


namespace App\Repositories;
use App\User;

class StaffRepository
{
    public function getUserData($userId) {
        $user = User::find($userId);
        $aUserData = [
            'username' => $user->name,
            'password' => $user->password
        ];
        return $aUserData;
    }
}
