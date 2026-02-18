<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(5);
        return view('permission.list',[
            'permissions' => $permissions,
        ]);

    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success', 'Permission added successfully');

        } else {
            return redirect()->route('permission.create')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function show() {}

    public function edit($id) {
        $permission = Permission::findOrFail($id);
        return view('permission.edit', [
            'permission' => $permission,
        ]);
    }


    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,'.$id.'|min:3'
        ]);

        if ($validator->passes()) {
            $permission = Permission::findOrFail($id);
            $permission->update(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success', 'Permission updated successfully');

        } else {
            return redirect()->route('permission.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $permission = Permission::find($id);
        if($permission == null){
            Session()->flash('error', 'Permission not found');
            return response()->json(['status' => false]);
        }
        $permission->delete();
        Session()->flash('success', 'Permission deleted successfully');
        return response()->json(['status' => true]);
    }
}
