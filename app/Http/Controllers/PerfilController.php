<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
        return view('perfiles.show',compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
        return view('perfiles.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        
        
        //R1. validar
        $data=request()->validate([
            'nombre'=>'required',
            'url'=>'required',
            'biografia'=>'required'
        ]);
        //T1 si el usuario sube una imagen
        if($request['imagen']){
            
            //. Obtener la ruta de la imagen
            $ruta_imagen=$request['imagen']->store('upload-perfiles','public');
            //. resize de la imagen
            // Usando la clase Image e importandola
            $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            //crear un arreglo de imagen
            $array_imagen=['imagen'=>$ruta_imagen];

        }else{
            return "no se subio";
        }
        //S1. Asignar nombre  y URL 
        auth()->user()->url=$data['url'];
        auth()->user()->name=$data['nombre'];
        auth()->user()->save();

        //Asignar Biografia e Imagen
        //puedes utilizar save() o tambien update ...y lo vamos a actualizar con la informacion de data
        //pero el campo de nombre y url no se encuentran en el perfil ...entonces UNA VEZ QUE SE GUARDA ESTA INFORMACION 
        //DE DATA hay que eliminarla 

        //Eliminar URL y Name  de $data ..para no enviar campos demás 
        unset($data['url']);
        unset($data['nombre']);

        //guardar informacion
        //aca en el perfil es donde igula vamos a guardar la imagen usando la funcion array_merge //esta une dos arreglos
        //entonces uniremos data y array_imagen
        auth()->user()->perfil()->update(array_merge(
            $data,
            $array_imagen??[]
        ));

        //redireccionar...no olvidar que para redireccionar en el accion se pasa el controlador y el metodo 
        return redirect()->action([RecetaController::class,'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
