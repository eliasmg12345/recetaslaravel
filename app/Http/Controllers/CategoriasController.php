<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use Illuminate\Http\Request;
use App\Models\Receta;

class CategoriasController extends Controller
{
    //LA1.
    public function show(CategoriaReceta $categoriaReceta)
    {
        $recetas=Receta::where('categoria_id',$categoriaReceta->id)->paginate(1);
        return view('categorias.show',compact('recetas','categoriaReceta'));
    }
}
