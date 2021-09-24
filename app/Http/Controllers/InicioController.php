<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    //
    public function index()
    {
        //JA1. Mostrar las recetas por cantidad de votos
        //$votadas=Receta::has('likes','>',0)->get();
        //otra forma de contar los likes es con withCount este te va a crear una columna nueva llamada (..count). columna temporal en resultados....
        //luego puedes odenarlas con orderBy...
        //ESTA FORMA ES MAS DINAMICA 
        $votadas=Receta::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();
        


        //GA1. obtener las recetas mas nuevas
        //$nuevas =Receta::orderBy('created_at','DESC')->get();
        //pERO LARAVEL tiene un metodo para traer lo mas reciente en base a created_at...y es latest...caso contrario es el oldtest
        $nuevas=Receta::latest()->take(5)->get();
        
        // IA1. recetas pro categoria--------lo que podemos es traer todas las categorias e ir iterando  y agrupando segun la categoria
        $categorias=CategoriaReceta::all();
        
        //agrupar las recetas por categoria .
        $recetas=[];
        //tendremos un arreglo en dos dimensiones
        foreach($categorias as $categoria){
            $recetas[Str::slug($categoria->nombre)][]=Receta::where('categoria_id',$categoria->id)->get();
        }
        
        return  view('inicio.index',compact('nuevas','recetas','votadas'));    
    }
}
