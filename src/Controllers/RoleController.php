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
use LaravelRoles\Roleman\Models\Role;
class RoleController extends Controller
{
    //
    public function index()
    {
        $users=\App\User::all();
        return view('roleman::user.list',['users'=>$users]);
    }
}
