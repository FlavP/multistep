<?php

namespace App\Http\Controllers;

use App\Repositories\StaffRepository;
use App\Traits\PictureUploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    use PictureUploadTrait;
    private $staffRepo;

    /**
     * StaffController constructor.
     */
    public function __construct()
    {
        $this->staffRepo = new StaffRepository();
    }

    /**
     * @param Request $request
     */
    public function changePicture(Request $request){
        // Get authenticated user
        $user = User::find(Auth::user()->id);
        // Check if a profile image has been uploaded
        if ($request->has('profile_picture')) {
            // Get image from post request
            $image = $request->file('profile_picture');
            // Make an image name based on user name and timestamp
            $fileName = Str::slug($user->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadPicture($image, null, $fileName);
            // Delete old picture
            if ($user->picture)
                $this->deletePicture(null, $user->picture);
            $user->picture = $fileName;
            $user->save();
            return [
                'success' => true,
                'message' => 'Picture has been changed successfully'
            ];
        }
    }

    /**
     * @param Request $request
     */
    public function setUser(Request $request){
        $response = '';
        $aData = $request->all();
        $aData['user_id'] = Auth::user()->id;
        if ($aData['edit'])
            $response = $this->staffRepo->editUser($aData);
        else
            $response = $this->staffRepo->newUser($aData);
        return $response;
    }
}
