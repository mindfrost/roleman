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
class AccessorController extends Controller
{
    //
    public function index()
    {
        $Accessors=Accessor::all();
        return view('roleman::accessor.list',['accessors'=>$Accessors]);
    }
    public function delete($id)
    {

        Accessor::destroy($id);
        return redirect()->back()->with('status','Удалено');
    }
    public function edit($id)
    {

        $Accessor=Accessor::findOrNew($id);
        $classes=Accessor::getAvailableClasses();
//        var_dump($Accessor->permissions);
//        var_dump($classes);
        return view('roleman::accessor.edit',['accessor'=>$Accessor,'classes'=>$classes]);
    }
    public function store(Request $request,$id)
    {

        $Accessor=Accessor::findOrNew($id);
        if($request->input('name')!=$Accessor->name)
        {
            $validator=$Accessor->validate($request->all());
            if(!$validator->passes())
            {
                $validator->errors()->getMessages();
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
        }


        $Accessor->fill($request->all());
        $Accessor->save();
        return redirect()->route('edit_accessor',$Accessor->id)->with('status','Изменения были сохранены');
    }
}
