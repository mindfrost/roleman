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
use LaravelRoles\Roleman\Models\Accessor;
use LaravelRoles\Roleman\Models\Permission;
use LaravelRoles\Roleman\Models\Role;
class PermissionController extends Controller
{
    //
    public function index()
    {
        $permissions=Permission::all();
        return view('roleman::permission.list',['permissions'=>$permissions]);
    }
    public function delete($id)
    {

        Permission::destroy($id);
        return redirect()->back()->with('status','Удалено');
    }
    public function edit($id)
    {

        $permission=Permission::findOrNew($id);
//        $a=$permission->accessor;
//       $permission->accessor->pid=$id;
//        var_dump($a);
        $accessors=Accessor::all();
        return view('roleman::permission.edit',['permission'=>$permission,'accessors'=>$accessors]);
    }
    public function store(Request $request,$id)
    {

        $permission=Permission::findOrNew($id);
        if($request->input('name')!=$permission->name)
        {
            $validator=$permission->validate($request->all());
            if(!$validator->passes())
            {
                $validator->errors()->getMessages();
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
        }


        $permission->fill($request->all());
        $permission->save();
        return redirect()->route('edit_permission',$permission->id)->with('status','Изменения были сохранены');
    }
}
