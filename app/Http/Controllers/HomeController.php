<?php

namespace App\Http\Controllers;

use App\Traits\PictureUploadTrait;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use PictureUploadTrait;
    private $staffRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('home', ['profilePicture' => $profilePicture]);
    }
}
