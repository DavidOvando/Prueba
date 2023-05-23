<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use App\Models\actores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function index(){
        return view('actores.index');
    }

    public function get(){
        return response()->json(['status' => true, 'actor' => actores::get()]);
    }
    public function getData(actores $actor){
        return response()->json(['actor' => $actor]);
    }
    public function getBusqueda($actor){
        $actor = DB::table('actores')->where('nombre','LIKE','%'.$actor.'%')
            ->get();
        return response()->json(['actor' => $actor]);
    }
    public function update(actores $actor, Request $request){
        $actor->update($request->all());
        $actor->save();
        return response()->json(['saved' => true]);
    }


    public function store(Request $request){
        $actor = actores::create($request->post());
        return response()->json([
            'actor'=>$actor
        ]);
    }

    public function delete(actores $actor){
        $actor->delete();
        return response()->json(['status' => true]);
    }

}
