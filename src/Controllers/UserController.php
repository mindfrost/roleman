<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.11.16
 * Time: 16:45
 */
namespace LaravelRoles\Roleman\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelRoles\Roleman\Models\Permission;
use LaravelRoles\Roleman\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {
        $users=User::all();
        return view('roleman::user.list',['users'=>$users]);
    }
    public function delete($id)
    {

        User::destroy($id);
        return redirect()->back()->with('status','Удалено');
    }

    public function edit(Request $request,$id)
    {
        $user=User::findOrNew($id);
        $roles=Role::all();
        var_dump($user->hasAccess('can_read_roles',$roles));
        return;
        return view('roleman::user.edit',['user'=>$user,'roles'=>$roles]);
    }
    public function store(Request $request,$id)
    {

        $user=User::find($id);
        $action=$request->input('action');

        if($action=="attach")
        {
            $user->attachRole($request->input('role'));
        }else
        {
            $user->detachRole($request->input('role'));
        }
        return redirect()->route('edit_user',$user->id)->with('status','Изменения были сохранены');
    }
    public function test()
    {
//        $user=User::find(2);
        $user=User::find(1);
        var_dump($user->hasPermission('can_create_roles'));
        var_dump($user->hasPermission('read_role_list'));
    }
}
