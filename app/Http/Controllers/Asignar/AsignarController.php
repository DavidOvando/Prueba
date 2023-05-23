<?php

namespace App\Http\Controllers\AsignarPelicula;

use App\Http\Controllers\Controller;
use App\Models\AsignarPelicula;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class AsignarPeliculaController extends Controller
{
    public function index(){
        $permisos=Permission::all();
        return view('Asignar.index',$permisos);
    }

    public function storeRole(Request $request){
        
        $newRole = new Role(['name' => $request->input('rol_name')]);
        $permissions = $request->input('permiso_name');
        $permissions = Permission::whereIn('name', $permissions)->get();
        //return response()->json(['permisos'=>$permissions]);
        //return response()->json(['rol'=>$newRole]);
        foreach ($permissions as $permissions) {
            
            // Aquí se pueden agregar más atributos que se quieran guardar
            $newRole->syncPermissions($permissions);
        }
        
        

        
        
        return response()->json(['status' => true]);
    }


    public function asignar(Request $request){
        $roles= role::all();
        return response()->json([
            'roles'=>$rol
        ]);
    }


}
