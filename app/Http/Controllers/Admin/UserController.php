<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use Illuminate\Database\QueryException;


class UserController extends Controller
{
    public function index(){
        return view('pages.admin.user.users', ['users' => (new UserModel)->getAll()]);
    }

    public function create(){
        return view('pages.admin.user.create_user', ['roles' => RoleModel::all() ]);
    }

    public function store(Request $request) {
        if($request->has('btnCreate')) {

            $request->validate([
                'username' => 'required|unique:users,username|regex:/^[A-Z][\d\w]{5,12}$/',
                'password' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
                'email'    => 'required|email|unique:users,email',
                'role'     => 'required'
            ]);
            $user = new UserModel();
            $user->username = $request->get('username');
            $user->email    = $request->get('email');
            $user->role_id  = $request->get('role');
            $user->active   = 1;
            $user->password = md5($request->get('password'));
            

            try {
                $user->save();
                return redirect()->back()->with('success', 'User Successfully created');
            }
            catch(QueryException $e) {
                \Log::error($e->getMessage());
                return redirect()->back()->with("error", "An server error has occurred, please try again later.");
            }

        }

    }

    public function delete($id){
        try{
            if(UserModel::destroy($id)){
                return redirect()->back()->with('success', 'User Deleted');
            }
        }   
        catch(QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while deleting user please try again');
        }
        
    }

    public function edit($id) {
        return view('pages.admin.user.edit_user',['user' => UserModel::find($id)], ['roles' => RoleModel::all()] );
    }

    public function update(Request $request) { 
        if($request->has('btnEdit')) {

            $request->validate([
                'username' => 'required|regex:/^[A-Z][\d\w]{5,12}$/',
                'password' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
                'email'    => 'required|email',
                'role'     => 'required',
                'active'   => 'required',
                'user_id'  => 'required',
            ]);
            
            $user = UserModel::find($request->get('user_id'));
            if($user) {

                $user->username = $request->get('username');
                $user->email    = $request->get('email');
                $user->role_id  = $request->get('role');
                $user->active   = $request->get('active');
                if($request->get('password') !== "")$user->password = md5($request->get('password'));
            

                try {
                    $user->save();
                    return redirect()->back()->with('success', 'User Successfully updated');
                }
                catch(QueryException $e) {
                    \Log::error($e->getMessage());
                    return redirect()->back()->with("error", "An server error has occurred, please try again later.");
                }

            }

        }
    }
}

