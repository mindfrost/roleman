<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.11.16
 * Time: 16:45
 */
namespace LaravelRoles\Roleman\Controllers;

use App\User;
use Auth;
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
//        var_dump($user->hasAccess('can_read_roles',$roles));
//        return;
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
//        $admin= new \LaravelRoles\Roleman\Models\Role();
//        $admin->fill([
//            'name'=>'admin',
//            'title'=>'Администратор',
//            'description'=>'Роль администратора системы'
//        ]);
//        $admin->save();
//        $can_create_permission=new \LaravelRoles\Roleman\Models\Permission();
//        $can_create_permission->fill(
//            [   'name'=>'can_create_permission',
//                'title'=>'Создание разрешений',
//                'description'=>'Разрешение на создание разрешений=)']
//        );
//        $can_create_permission->save();
//
//        $user= \LaravelRoles\Roleman\Models\Role::where('name','user')->first();
//        $user->title='Просто пользователь';
//        $user->save();
//
//        $manager_role=\LaravelRoles\Roleman\Models\Role::where('name','manager')->first();
//        $can_create_permission=\LaravelRoles\Roleman\Models\Permission::where('name','can_create_permission');
//        $user=\App\User::first();
//        $user->attachRole($manager_role->id);
//        $manager_role->attachPermission($can_create_permission->id);

//        $user=User::find(1);
        $user=User::find(2);
        $object=new \stdClass();
        $object->data="Секретные данные";
        $object->users_id=[2,5,7];
        if($user->hasAccess('can_read_secret',$object)){
            //предоставить доступ
            // выполнить требуемые операции
            print($object->data);
        }else{
            throw new \Exception('Ошибка доступа');
        }

    }
}
