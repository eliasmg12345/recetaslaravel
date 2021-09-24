<?php

namespace App\Providers;

use App\Models\CategoriaReceta;
use View;

use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // KA1. VAMOS A UTLIZAR view porque vamos a pasar nuestras categorias hacia la vista 
        //utilizaremos una sintaxis llamada composer aqui le ponemos * que a todas las vistas le va a pasar las categorias 

        View::composer('*',function($view){
            // para pasar las categoria de la base de datos
            $categorias=CategoriaReceta::all(); 
            $view->with('categorias',$categorias);
        });
    }
}
