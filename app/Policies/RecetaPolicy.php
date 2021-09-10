<?php

namespace App\Policies;

use App\Models\Receta;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Receta $receta)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Receta $receta)
    {
        //N1. revisa el usuario autenticado es el mismo que creo la receta
        return $user->id===$receta->user_id; 
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Receta $receta)
    {
        //
        //. revisa el usuario autenticado es el mismo que creo la receta

        return $user->id===$receta->user_id; 

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Receta $receta)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Receta $receta)
    {
        //
    }
}
