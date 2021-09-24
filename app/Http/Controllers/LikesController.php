<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, Receta $receta)
    {
        //AA2 Almacena los likes de un usuario  a una receta ....vamos a poner a meGusta com funcion y vamo a  utilizar un metodo toggle ....funciona como hleper que viene en laravel y le pasamos la receta de bido a que lo asociamos al modelo cuando creamos al controladorpues va tener la informacion de la receta  que estamos viendo ...toggle es uscado como en twitter y fb con los likes y dislikes
        return auth()->user()->meGusta()->toggle($receta);
    }

}
