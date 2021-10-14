<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BackendController extends Controller
{
    // This is the function for profile: To be called in web.php in routes folder to give a route to the profile page
    public function profile(){
        $user = array();
        if (Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();
        }
        else{

        }
        return view('profile', compact('user'));
    }

    // Update user profile
    public function updateProfile(Request $request) {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
        ]);

        $authUser = Auth::user();
        $authUser->name = $request->name;
        $authUser->email = $request->email;


    }
}
