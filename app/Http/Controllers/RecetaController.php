<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class RecetaController extends Controller
{

    public function __construct()
    {
        //A1.
        //Middleware de autenticacion
        //con auth estamos habilitando middleware  una vez que se crea
        //uina instancia con recetaController por tanto protege los demas metodos
        //ya no se puede acceder 
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // G1 vamos a acceder a la relacion recetas
        //es lo mismo acceder Auth:: que con auth()->
        //Auth::user()->recetas->dd();
        //pasaremos este objeto a la vista con el with
        $recetas=auth()->user()->recetas; 
        return view('recetas.index')->with('recetas',$recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //B1. 
        //Hay diferentes formas de hacerlo una es usando DB:: y que eciste uun
        //metodo que eciste en DB  que se llama get y el dd es como el dump para que nos muestre
        //el resultado ....NO  ES NECESARIO PONER UN SELECT 
        //para que solo nos traiga los campos requeridos usammos el pluck y quitamos el dd
        //DB::table('categoria_receta')->get()->pluck('nombre','id')->dd();
        $categorias= DB::table('categoria_recetas')->get()->pluck('nombre','id');

        //en lugar de pasarle con un compact lo pasaremos con un with
        return view('recetas.create')->with('categorias',$categorias);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //D1.
        //si inttentamos guardar la imgagen lo ariamos con una funacion llamada store
        //esto lo guarda en el disco duro del servidor..colocando la carpeta que va a guardar
        //dd($request['imagen']->store('upload-recetas','public'));



        //request() es lo mismo que $request
        //la funcion request lo guardamos en data 
        //validate es un metodo que existe en el request
        $data=$request->validate([
            'titulo'=>'required|min:6',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required|image',
            'categoria'=>'required',
        ]);
        //DB es lo que se conoce como un facade...son funcoines que basicamente pueden
        //llegar a ser complejas...en este caso por ejemplo insertar un registro en la base de datos
        //la operacion de ->insert insertaremos un arreglo

        //para saber cual es el usuario autenticado laravel tiene un helper Auth
        //retorna quee usuario es autenticado----te devuelve que usuario esta autenticado

        //D2. Obtener la ruta de la imagen
        $ruta_imagen=$request['imagen']->store('upload-recetas','public');

        
        //E1. resize de la imagen
        // Usando la clase Image e importandola
        $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(1200,500);
        $img->save();


        //Almacenar en la base de datos  (sin modelo)
        DB::table('recetas')->insert([
            'titulo'=>$data['titulo'],
            'preparacion'=>$data['preparacion'],
            'ingredientes'=>$data['ingredientes'],
            'imagen'=>$ruta_imagen,
            'user_id'=>Auth::user()->id,
            'categoria_id'=>$data['categoria'],
        ]);
        //funcion dd es similar al var_dump
        //el request es lo que se envia hacia el store
        //dd($request->all());

        //REDIRECCIONANDO
        return redirect()->action([RecetaController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
