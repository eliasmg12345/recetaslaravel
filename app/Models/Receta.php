<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory; 

    protected $fillable = [
        'titulo',
        'preparacion',
        'ingredientes',
        'imagen',
        'categoria_id'
    ];


    //I1. Obtiene la categoria de la receta via FK
    public function categoria()
    {
        //en este caso vamos a tener una relacion  1 a 1 
        //podemos ver que el categoria_id pertenece a las categorias....muchas recetas pertenece a una categoria (n a 1) 
        //por lo tanto la categoria va a pertenecer a belongsTo(CategoriaReceta)
        return $this->belongsTo(CategoriaReceta::class);
    }

    //L1. Obtiene la informacion del usuario via FK
    public function autor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    //Z1. Links que ha recibido una receta 
    public function likes()
    {
        return $this->belongsToMany(User::class,'likes_receta');
    }
}
