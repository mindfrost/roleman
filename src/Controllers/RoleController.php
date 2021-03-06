<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.11.16
 * Time: 16:45
 */
namespace LaravelRoles\Roleman\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelRoles\Roleman\Models\Permission;
use LaravelRoles\Roleman\Models\Role;
class RoleController extends Controller
{
    //
    public function index()
    {
        $roles=Role::all();
        return view('roleman::role.list',['roles'=>$roles]);
    }
    public function delete($id)
    {

       Role::destroy($id);
        return redirect()->back()->with('status','Удалено');
    }
    public function edit($id)
    {
        $role=Role::findOrNew($id);


//    $permission=$role->permissions->first();
//        if($permission)
//        var_dump($permission->pivot->type);

//        return;
        $permissions=Permission::all();
        $roles=Role::all();
        return view('roleman::role.edit',['role'=>$role,'permissions'=>$permissions,'roles'=>$roles]);
    }
    public function store(Request $request,$id)
    {

        $role=Role::findOrNew($id);
        if($request->input('name')!=$role->name)
        {
            $validator=$role->validate($request->all());
            if(!$validator->passes())
            {
                $validator->errors()->getMessages();
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
        }


        $role->fill($request->all());
        $role->save();
        return redirect()->route('edit_role',$role->id)->with('status','Изменения были сохранены');
    }
    public function permissions(Request $request,$id) {
        $role=Role::find($id);
        $action=$request->input('action');
        $type=$request->input('type')?$request->input('type'):0;

        if($action=="attach")
        {
            $role->attachPermission($request->input('permission'),$type);
        }else
        {
            $role->detachPermission($request->input('permission'));
        }
        return redirect()->route('edit_role',$role->id)->with('status','Изменения были сохранены');
    }
    public function parents(Request $request,$id) {
        $role=Role::find($id);
        $type=$request->input('type')?$request->input('type'):0;
        $action=$request->input('action');

        if($action=="attach")
        {
            $role->attachRole($request->input('parent_role_id'),$type);
        }else
        {
            $role->detachRole($request->input('parent_role_id'));
        }
        return redirect()->route('edit_role',$role->id)->with('status','Изменения были сохранены');
    }
}
