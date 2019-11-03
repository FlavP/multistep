<?php


namespace App\Repositories;
use App\User;

class StaffRepository
{

    /**
     * @param $aData
     * @return array
     * @throws \Exception
     */
    public function newUser($aData) {
        $uniqueUser = $this->validate($aData['username'], $aData['email']);
        if ($uniqueUser['success']){
            $user = new User();
            $user->name = $aData['username'];
            $user->email = $aData['email'];
            $user->password = bcrypt($aData['password']);
            $user->is_active = $aData['active'];
            $user->role = $aData['role'];
            $user->added_by = $aData['user_id'];
            $user->created_at = new \DateTime();
            $user->save();
            return [
                'success' => true,
                'message' => 'The user has been added'
            ];
        }
        return $uniqueUser;
    }

    public function editUser($aData) {
        $user = User::find($aData['user_id']);
        if ($user->password === bcrypt($aData['password'])) {
            $user->password = bcrypt($aData['new']);
            return [
                'success' => true,
                'message' => 'The password has been changed'
            ];
        }
        return [
            'success' => false,
            'message' => 'The password you entered is wrong'
        ];
    }

    protected function validate($userName, $email) {
        if (User::where('name', $userName)->count() > 0)
            return [
                'success' => false,
                'message' => 'A user with that name already exists'
            ];
        if (User::where('email', $email)->count() > 0)
            return [
                'success' => false,
                'message' => 'A user with that email address already exists'
            ];
        else
            return [
                'success' => true
            ];
    }
}
