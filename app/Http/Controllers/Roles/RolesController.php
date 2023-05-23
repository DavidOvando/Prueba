<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    

    public function index(){
        return view('roles.index');
    }

    public function get(){
        return response()->json(['status' => true, 'roles' => Roles::get()]);
    }
    public function getData(Roles $roles){
        return response()->json(['roles' => $roles]);
    }
    public function update(Roles $roles, Request $request){
        $roles->update($request->all());
        $roles->save();
        return response()->json(['saved' => true]);
    }


    public function store(Request $request){
        $roles = Roles::create($request->post());
        return response()->json([
            'roles'=>$roles
        ]);
    }

    public function delete(Roles $roles){
        $roles->delete();
        return response()->json(['status' => true]);
    }

}
