@extends('layouts.app')

@section('botones')
    <a href="{{route('recetas.create')}}" class="btn btn-primary mr-2 text-white">Crear Receta</a>
@endsection

@section('content')
    
    <h2 class="text-center mb-5">Administra tus recetas</h2>


    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recetas as $rec)
                    <tr>
                        <td>{{$rec->titulo}}</td>
                        <td>{{$rec->categoria->nombre}}</td>
                        <td>
                            {{--
                            <form action="{{route('recetas.destroy',['receta'=>$rec->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger d-block w-100 mb-2" value="Eliminar &times;">
                            </form>    
                            --}}
                            <eliminar-receta
                                receta-id={{$rec->id}}
                            ></eliminar-receta>                     

                            
                            <a href="{{route('recetas.edit',['receta'=>$rec->id])}}" class="btn btn-dark d-block mb-2">Editar</a>
                            <a href="{{route('recetas.show',['receta'=>$rec->id])}}" class="btn btn-success d-block mb-2">Ver</a>
                        </td>
                    </tr> 
                @endforeach
                 
                
            </tbody>
        </table>
    </div>
@endsection