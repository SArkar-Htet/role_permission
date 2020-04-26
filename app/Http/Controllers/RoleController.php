<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
       $this->middleware('permission:role-list');
       $this->middleware('permission:role-create', ['only' => ['create','store']]);
       $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = Role::paginate('5');
      return view('roles.home')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'description' => 'required'
      ]);
      $role = new Role;
      $role->name = $request->name;
      $role->description = $request->description;
      $role->save();
      return redirect('/admin/roles')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $role = Role::find($id);
      return view('roles.edit')->with('role', $role);
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
      // dd($request->all());
      $this->validate($request, [
        'name' => 'required',
        'description' => 'required'
      ]);
      $role = Role::find($id);
      $role->name = $request->name;
      $role->description = $request->description;
      $role->save();
      return redirect('/admin/roles')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Role::destroy($id);
      return redirect('/admin/roles')->with('success' ,'Role deleted successfully');
    }

    public function permission($id)
    {
      
      $role = Role::find($id);
      $permissions = Permission::get();
      return view('roles.permission')->with('role', $role)
                                     ->with('permissions', $permissions);
    }

    public function setPermission($role, Request $request)
    {
      // Role_Has_Permission::where('role_id', $role)->forceDelete();
      $role = Role::find($role);
      $role->name = $request->name;
      $role->description = $request->description;
      $role->save();
      $role->syncPermissions($request->permission);
      return redirect('admin/roles')->with('success','Permission successfully');
    }

}
