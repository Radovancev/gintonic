<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Database\QueryException;

class LoginController extends Controller
{
    public function register(Request $request) {
        if($request->has('btnSubmit')) {

            $request->validate([
                'username' => 'required|unique:users,username|regex:/^[A-Z][\d\w]{5,12}$/',
                'password' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
                'email'    => 'required|email|unique:users,email'
            ]);
            $user = new UserModel();
            $user->username = $request->get('username');
            $user->email    = $request->get('email');
            $user->password = md5($request->get('password'));
            

            try {
                $user->save();
                return redirect('/')->with('success', 'Please check your mail before you login, you need to active your account');
            }
            catch(QueryException $e) {
                \Log::error($e->getMessage());
                return redirect()->back()->with("error", "An server error has occurred, please try again later.");
            }

        }
    }


    public function logout() {
        session()->forget('user');
        session()->flush();
        return redirect('/');
    }

    public function login(Request $request) {
        if($request->has('btnLogin')) {
            $request->validate(
                [
                    'email'     => 'required|email',
                    'password'  => 'required'
                ]
            );
        $email = $request->get('email');
        $pass = md5($request->get('password'));
        $user = UserModel::where('email' ,$email)->where('password', $pass)->where('active', 1)->first();
        
        if($user === null) {
            return redirect()->back()->with('error', 'Please enter valid info or check your mail for activation link');
        }
        else {
            $request->session()->push('user', $user);
            return redirect('/')->with('success', 'Succesfully logged in. You can now comment on posts');
        }
        }
    }
}
