<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    // This is the function for login: To be called in web.php in routes folder
    public function login(){
        return view("auth.login");
    }
    // This is the function for registration: To be called in web.php in routes folder
    public function registration(){
        return view("auth.registration");
    }
    // This function should be triggered once the sign up button is clicked
    public function registerUser(Request $request) {
        // The validate method should validate the credentials entered in the sign up form
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:20',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if ($res){
            return back()->with('success','Sign up successfull!');
        }
        else{
            return back()->with('fail','Unfortunately, something is wrong!');
        }

    }
    public function loginUser(Request $request) {
        // The validate method should validate the credentials entered in the login form
        $request->validate([
            'email'=>'required|email|',
            'password'=>'required|min:5|max:20',
        ]);
        // Check whether the email exists
        $user = User::where('email','=',$request->email)->first();
        if($user){
            // Condition to check if the password entered matches with the one in the database
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('dashboard');
            }
            else{
                return back()->with('fail','Incorrect email or password!');
            }
        }
        else{
            return back()->with('fail','This user does not exist!');
        }
    }
    // Display the user's name and email in the dashboard with some actions
    public function dashboard(){
        $data = array();
        if (Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        else{

        }
        return view('dashboard', compact('data'));
    }
    // Function for log out action
    public function logout(){
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}