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
                            <a href="" class="btn btn-danger">Eliminar</a>
                            <a href="{{route('recetas.edit',['receta'=>$rec->id])}}" class="btn btn-dark">Editar</a>
                            <a href="{{route('recetas.show',['receta'=>$rec->id])}}" class="btn btn-success">Ver</a>
                        </td>
                    </tr> 
                @endforeach
                 
                
            </tbody>
        </table>
    </div>
@endsection