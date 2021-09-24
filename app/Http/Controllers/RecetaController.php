<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
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
        $this->middleware('auth',['except'=>['show','search']]);
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
        //$recetas=auth()->user()->recetas; 

        //W1. Recetas con paginacion y comentando el G1...usando el ELOQUENT
        //FA1
        $usuario=auth()->user();
        $recetas=Receta::where('user_id',$usuario->id)->paginate(1);
        return view('recetas.index')
        ->with('recetas',$recetas)
        ->with('usuario',$usuario);
                                    
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
        //estamos obteniendo categorias (sin modelos)
        $categorias= DB::table('categoria_recetas')->get()->pluck('nombre','id');

        //H1. Obteniendo categorias con modelo. el metodo all nos va a trare todas las 
        //categorias que hay en essa tabla
        $categorias=CategoriaReceta::all('id','nombre');

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
        /*DB::table('recetas')->insert([
            'titulo'=>$data['titulo'],
            'preparacion'=>$data['preparacion'],
            'ingredientes'=>$data['ingredientes'],
            'imagen'=>$ruta_imagen,
            'user_id'=>Auth::user()->id,
            'categoria_id'=>$data['categoria'],
        ]);

        */

        //J1 Almacenar en la base de datos (con modelo)
        //tomamos el auth()->  para el usuario que esta autenticado----despues accedemos a 
        //la informacion del usuario al objeto del usuario y despues accedemos  a sus recetas...este 
        //es el que ya has definido en el modelo User...en este caso es recetas...y como tenemos un modelo con el ORM
        //le podemos poner create para crear una nueva receta....se pasa un arreglo cuando se crea
        auth()->user()->recetas()->create([
            'titulo'=>$data['titulo'],
            'preparacion'=>$data['preparacion'],
            'ingredientes'=>$data['ingredientes'],
            'imagen'=>$ruta_imagen,
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
        //CA1 OBTENER Si el usuario actual le gusta la receta y esta autenticado... como en el metodo megusta nos va a adevolver un array grande ..laravel tiene un metodo contains....de esa forma vas a revisar...si le pasas un id va a verificar si existe en los me gusta 
        //en otras palabras si el usuario esta autenticado vamos a revisar si ya lo tiene como megusta ----si el contrins me retorna que no entonces es folse...pero si no esta autenticado tambien me pasa false
        //like le pasamos al show.blade    
        $like=(auth()->user()) ? auth()->user()->meGusta->contains($receta->id):false;

        //DA1. PASA LA cantidad de likes a la vista----en laravel existe un helper que nos diga cuantos elementos hay en este arreglo 
        $likes=$receta->likes->count();

        return view('recetas.show',compact('receta','like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //V2. REVISANDO EL POLICY..(con el nombre del metodo en el policy en este caso es el update y le pasas la $receta actual)
        $this->authorize('view',$receta);

        //
        //M1. Obteniendo categorias con modelo. el metodo all nos va a trare todas las 
        //categorias que hay en essa tabla
        $categorias=CategoriaReceta::all('id','nombre');
        //N1. como tenemos una instancia de Receta puedo poner una copia y pasar esa receta al with o compact 
        return view('recetas.edit')->with('categorias',$categorias)
                                    ->with('receta',$receta);
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
        //N2. REVISANDO EL POLICY..(con el nombre del metodo en el policy en este caso es el update y le pasas la $receta actual)
        $this->authorize('update',$receta);

        //validando
        $data=$request->validate([
            'titulo'=>'required|min:6',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'categoria'=>'required',
        ]);

        //asginar los valores 
        $receta->titulo=$data['titulo'];
        $receta->ingredientes=$data['ingredientes'];
        $receta->preparacion=$data['preparacion'];
        $receta->categoria_id=$data['categoria'];

        //si el usuario sube una nueva imagen
        if(request('imagen')){
            //. Obtener la ruta de la imagen
            $ruta_imagen=$request['imagen']->store('upload-recetas','public');
            //. resize de la imagen
            // Usando la clase Image e importandola
            $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(1200,500);
            $img->save();
            //asignar al objeto
            $receta->imagen=$ruta_imagen;
        }

        $receta->save();

        //redireccionando
        return redirect()->action([RecetaController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //ejecutando el policy 
        $this->authorize('delete',$receta);
        //eliminar  la receta
        $receta->delete();
        return redirect()->action([RecetaController::class,'index']);
    }

    //MA2...
    public function search(Request $request)
    {
        //recuerda que el buscar viene del name del input
        //$busqueda=$request['buscar'];
        //otra forma de buscar es con la funcio get
        $busqueda=$request->get('buscar');

        //NA1.-.le pasamos el operador like 
        $recetas=Receta::where('titulo','like','%'.$busqueda.'%')->paginate(1);
        $recetas->appends(['buscar'=>$busqueda]);
        return view('busquedas.show',compact('recetas','busqueda'));
    }
}
