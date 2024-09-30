<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        // if(!auth()->user()->can('roles.view'))
        // {
        //     abort(403, 'unauthorized');
        // }
        $roles = Role::paginate(10);
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->can('roles.create'))
        // {
        //     abort(403, 'unauthorized');
        // }


        $permissions = Permission::orderby('name')->get();

        return view('backend.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(!auth()->user()->can('roles.create'))
        // {
        //     abort(403, 'unauthorized');
        // }


        $request->validate([
            'name' => 'required|unique:roles'
        ], 
        [
            'name.required' => 'The role name field is required.',
            'name.unique' => 'The role name has already been taken.',
        ]);

        $role = Role::create(['name' => $request->name]);
        if($request->has('permissions'))
        {
            $role->syncPermissions($request->permissions);
        }

        return response()->json(['status'=>true ,'msg'=>'Role created successfully','url'=>route('admin.roles.index')]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!auth()->user()->can('roles.edit'))
        // {
        //     abort(403, 'unauthorized');
        // }

         $role = Role::findOrFail($id);
         $permissions = Permission::orderby('name')->get();

        return view('backend.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if(!auth()->user()->can('roles.edit'))
        // {
        //     abort(403, 'unauthorized');
        // }

        $request->validate([
            'name' => 'required'
        ], 
        [
            'name.required' => 'The role name field is required.',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        if($request->has('permissions'))
        {
            $role->syncPermissions($request->permissions);
        }
        
        else {
            foreach($request->permissions as $permission)
            {
                $role->revokePermissionTo($permission);
            }
        }
        
        return response()->json(['status'=>true ,'msg'=>'Role updated successfully','url'=>route('admin.roles.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->can('roles.delete'))
        // {
        //     abort(403, 'unauthorized');
        // }

        Role::destroy($id);

        return response()->json(['status'=> true, 'msg' => 'Role deleted']);
    }


}
