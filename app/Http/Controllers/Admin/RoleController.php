<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{
    public function index(){
        return view('pages.admin.role.roles', ['roles' => RoleModel::all()]);
    }

    public function create(){
        return view('pages.admin.role.create_role');
    }

    public function store(Request $request){
        if($request->has('btnSubmit')) {
            $request->validate([
                'role' => 'required|regex:/^[a-z]{3,15}$/'
            ]);
            
            $role = new RoleModel();
            $role->role_name = $request->get('role');

            try {
                $role->save();
                return redirect()->back()->with('success', 'Role Created');

            }   
            catch(QueryException $e) {
                \Log::error($e->getMessage());
                return redirect()->back()->with('error', 'Error while creating role please try again later');
            }
        }
    }

    public function delete($id){
        try{
            if(RoleModel::destroy($id)){
                return redirect()->back()->with('success', 'Role Deleted');
            }
        }   
        catch(QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while deleting role please try again later');
        }
        
    }

    public function edit($id){
        return view('pages.admin.role.edit_role', ['role' => RoleModel::find($id)]);
    }
    public function update(Request $request){
        if($request->has('btnEdit')) {
            $request->validate([
                'role' => 'required|regex:/^[a-z]{3,15}$/',
                'role_id' => 'required',
            ]);
            
            $role = RoleModel::find($request->get('role_id'));
            $role->role_name = $request->get('role');

            try {
                $role->save();
                return redirect()->back()->with('success', 'Role Updated');

            }   
            catch(QueryException $e) {
                \Log::error($e->getMessage());
                return redirect()->back()->with('error', 'Error while updating role please try again later');
            }
        }
        
    }
}
