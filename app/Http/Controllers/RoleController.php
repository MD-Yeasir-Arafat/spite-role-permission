<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;


use function Pest\Laravel\session;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name', 'Asc')->paginate(1);
        return view('role.list',[
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|min:3'
        ]);

        if ($validator->passes()) {
                $role = Role::create(['name' => $request->name]);
           if($request->permissions){
                foreach ($request->permissions as $name) {
                    $role->givePermissionTo($name);
                }
           }

           return redirect()->route('role.index')->with('success', 'Role added successfully');

        } else {
            return redirect()->route('role.create')
                ->withInput()
                ->withErrors($validator);
        }

    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $haspermissions = $role->permissions()->pluck('name');
        $permissions = Permission::all();
        return view('role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'haspermissions' => $haspermissions
        ]);
    }

    public function update($id , Request $request) {
        $role = Role::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.'|min:3'
        ]);

         if ($validator->passes()) {
                $role->name = $request->name;
                $role->save();
           if($request->permissions){
                $role->syncPermissions($request->permissions);
           } else {
                $role->syncPermissions([]);
           }

           return redirect()->route('role.index')->with('success', 'Role updated successfully');

        } else {
            return redirect()->route('role.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        if($role == null) {
        Session::flash('error', 'Role not found');
            return response()->json([
                'status' => false,
            ]);
        }
        $role->delete();

         Session::flash('success', 'Role deleted successfully');
        return response()->json([
            'status' => true,
        ]);
    }
}
