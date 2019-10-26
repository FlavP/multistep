<?php

namespace App\Http\Controllers;

use App\Repositories\StaffRepository;
use App\Traits\PictureUploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use PictureUploadTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->staffRepo = new StaffRepository();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::user()->id;
        // Get authenticated user
        $user = User::find($userId);
        $profilePicture = $this->getPicture(null, $user->picture);
        $userData = $this->staffRepo->getUserData($userId);
        return view('home', ['profilePicture' => $profilePicture, 'userData' => $userData]);
    }
}
