<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    // View single user
    public function userDetails($id)
    {
        if(Auth::user()->roles == 'Admin'){
            $user = User::find($id);
            return view('userDetail', compact('user'));
        }
        return redirect('/login');
    }

    public function updateUserDetails(Request $request){

        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'user_name' => 'required',
            'user_mail' => 'required|email',
            'roles' => 'required',
        ]);

        $user = User::find($request->id);
        $user->name = $request->user_name;
        $user->email = $request->user_mail;
        $user->roles = $request->roles;

        // dd($user);
        $user->save();

        return redirect('/userDetails/'.$request->id)->with('Success', 'Success Update Data');
    }

    // Update user's name
    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_name' => 'required'
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->user_name;
        $user->save();

        return redirect('/profile')->with('Success', 'Sucess Change Name');
    }

    // Update user's password
    public function password(Request $request)
    {
        // dd(Auth::user());
        // dd(bcrypt($request->old_pass));
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required|min:8',
            'conf_pass' => 'required'
        ]);

        if((Hash::check($request->old_pass, Auth::user()->password))){
            // dd(Auth::user()->id);
            if($request['old_pass'] == $request['new_pass']){
                return redirect('/changePassword')->with('error', 'New Password And Old Password Must Be Different');
            }

            if($request['new_pass'] == $request['conf_pass']){
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt($request->new_pass);
                $user->save();

                Auth::loginUsingId($user->id);
                return redirect('/changePassword')->with('Success', 'Success Change Password');
                // dd(Auth::user());
            }
            return redirect('/changePassword')->with('error', 'New Password Must Be Same With Confirmation Password');
        }

        return redirect('/changePassword')->with('error', "Old Password is Wrong");
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        if($request->id == Auth::user()->id){
            return redirect('/manageUser')->with('error', 'Cant Delete Own Account');
        }

        $user = User::find($request->id);
        $user->delete();

        return redirect('/manageUser')->with('Success', 'Success Delete User Account');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($request->remember){
            // TODO: Validate days and seconds in Cookie::queue
            // Cookie::queue('email', $request->email, 7);
            Cookie::queue('email', $request->email, 300);
        }

        $request->password = bcrypt($request->password);

        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)) {
            return redirect('/home');
        }

        return view('/login')->with('error', 'Cant Login, Try Again Later!');
    }

    public function registerUser(Request $request){
        $users = User::all();

        foreach($users as $user){
            if($user->email == $request->email){
                return redirect('/register')->with('error', 'Email has Been Used Before');
            }
        }

        $request -> validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',
            'conf_password' => 'required'
        ]);

        if($request['password'] == $request['conf_password']){
            $data = $request->all();
            $check = $this->createUser($data);
            Auth::login($check);
            return redirect('/home');
        }else{
            return redirect('/register')->with('error', 'Confirmation Password Wrong');
        }
    }

    public function createUser(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
          ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/home');
    }
}
