<?php

namespace App\Http\Controllers\Pelicula;

use App\Http\Controllers\Controller;
use App\Models\peliculas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeliculaController extends Controller
{
    public function index(){
        return view('peliculas.index');
    }

    public function get(){
        return response()->json(['status' => true, 'pelicula' => peliculas::get()]);
    }
    public function getData(peliculas $pelicula){
        return response()->json(['pelicula' => $pelicula]);
    }
    public function update(peliculas $pelicula, Request $request){
        $pelicula->update($request->all());
        $pelicula->save();
        return response()->json(['saved' => true]);
    }
    public function getBusqueda($pelicula){
        $pelicula = DB::table('peliculas')->where('titulo','LIKE','%'.$pelicula.'%')
            ->get();
        return response()->json(['pelicula' => $pelicula]);
    }
    public function store(Request $request){
        $pelicula = peliculas::create($request->post());
        return response()->json([
            'pelicula'=>$pelicula
        ]);
    }

    public function delete(peliculas $pelicula){
        $pelicula->delete();
        return response()->json(['status' => true]);
    }

}
