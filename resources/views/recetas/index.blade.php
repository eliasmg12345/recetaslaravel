@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')    
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
        {{-- W1 agreando paginacion--}}
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>
        {{-- FA2 añadiendo la parte de me gustas --}}
        <h2>Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if (count($usuario->meGusta)>0)
                <ul class="list-group">
                    @foreach ($usuario->meGusta as $receta)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{$receta->titulo}}</p>
                            <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{route('recetas.show',['receta'=>$receta->id])}}">Ver</a>
                        </li>
                        
                    @endforeach
                </ul>
            @else
                <p class="text-center">Aun no tienes recetas guardadas
                    <small> Dale megusta a las recetas y apareceran aqui</small>
                </p>
            @endif

            
        </div>
    </div>
@endsection