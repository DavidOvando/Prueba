<?php

namespace App\Http\Controllers\Permisos;

use App\Http\Controllers\Controller;
use App\Models\Permisos;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function index(){
        return view('permisos.index');
    }

    public function get(){
        return response()->json(['status' => true, 'permisos' => Permisos::get()]);
    }
    public function getData(Permisos $permisos){
        return response()->json(['permisos' => $permisos]);
    }
    public function update(Permisos $permisos, Request $request){
        $permisos->update($request->all());
        $permisos->save();
        return response()->json(['saved' => true]);
    }


    public function store(Request $request){
        $permisos = Permisos::create($request->post());
        return response()->json([
            'permisos'=>$permisos
        ]);
    }

    public function delete(Permisos $permisos){
        $permisos->delete();
        return response()->json(['status' => true]);
    }

}
