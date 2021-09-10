<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //P1 Evento que se ejecuta cuando un suario es creado
    protected static function boot()
    {
        parent::boot();
        //crearemos un metodo (created)una vez asignado un perfil
        //asignar peril una vez se haya creado un usuario nuevo
        //del metodo una vez creado vamos a utilizar un closures..le pasamos el usuario actual..le ponemos user  y como definimos la relacion como 
        //perfil entoncex ponemos flecha perfil  y le ponemos create para que se cree ese nuevo perfil de la misma forma como creamos para recetas...pero en este caso una vez creado el usuario 
        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    //F1-
    //Relacion de 1:n de Usuario a Recetas 
    //en esta parte se va a ir definiendo lo que se vaya agregando lo que el usuario 
    // vaya creando
    public function recetas()
    {
        //con estodoremos que este modelo User tendra una relacion de 1n(hasMany) con el modelo de receta
        //
        return $this->hasMany(Receta::class);
    }

    //O1 Relacion de 1:1 de usuario y perfil
    public function perfil()
    {
        return $this->hasOne(Perfil::class);    
    }
}
