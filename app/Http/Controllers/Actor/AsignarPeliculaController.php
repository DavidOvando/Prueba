<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use App\Models\AsignarPelicula;
use Illuminate\Http\Request;

class AsignarPeliculaController extends Controller
{
    
    public function get(){
        return response()->json(['status' => true, 'asignarPelicula' => asignarPelicula::get()]);
    }
    public function getData(asignarPelicula $asignarPelicula){
        return response()->json(['asignarPelicula' => $asignarPelicula]);
    }


    public function store(Request $request){
        $asignarPelicula = asignarPelicula::create($request->post());
        return response()->json([
            'asignarPelicula'=>$asignarPelicula
        ]);
    }

    public function delete(actores_peliculas $actores_pelicula){
        $actores_pelicula->delete();
        return response()->json(['status' => true]);
    }

}
