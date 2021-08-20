<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetasController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        $recetas =['recetas pizza','receta hamburguesa','receta tacos'];
        $categorias=['comida mexicana','comida boliviana','postres'];

        return view('recetas.index')
                    ->with('recetas',$recetas)
                    ->with('categorias',$categorias);
        
        //return view('recetas.index',compact('recetas'));
    }
}
