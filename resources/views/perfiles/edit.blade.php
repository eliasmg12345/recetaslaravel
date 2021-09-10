@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white">ver Receta</a>
@endsection

@section('content')

    <h1 class="text-center">Editar mi perfil</h1>

    {{$perfil->usuario}}
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form 
                action="{{route('perfiles.update',['perfil'=>$perfil->id])}}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    {{--    para que me resalte el cuadro de alrrta usammos:
                            @error  con la clase de bootstrap is-invalid

                            y para que mantenga el campo se usa el old que es el ultimo request previo
                    --}}
                    <input type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        id="nombre" 
                        placeholder="tu nombre " 
                        value="{{$perfil->usuario->name}}"
                    >    
                    {{--directiva de laravel para validadcion es el @error
                        el message lo genera automaticamente laravel--}}
                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Sitio Web</label>
                    {{--    para que me resalte el cuadro de alrrta usammos:
                            @error  con la clase de bootstrap is-invalid

                            y para que mantenga el campo se usa el old que es el ultimo request previo
                    --}}
                    <input type="text" 
                        name="url" 
                        class="form-control @error('url') is-invalid @enderror" 
                        id="url" 
                        placeholder="tu sitio Web " 
                        value="{{$perfil->usuario->url}}" 
                    >    
                    {{--directiva de laravel para validadcion es el @error
                        el message lo genera automaticamente laravel--}}
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group mt-3">
                    <label for="biografia">Biografia</label>
                    <input type="hidden" 
                        name="biografia" 
                        id="biografia" 
                        value="{{$perfil->biografia}}"
                    >

                    <trix-editor
                        class=" form-control @error('biografia') is-invalid @enderror"
                        input="biografia"
                    
                    ></trix-editor>

                    @error('biografia') 
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group mt-3">
                    <label for="imagen">tu Imagen</label>
                    <input 
                        type="file" 
                        id="imagen" 
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                    >

                    @if ($perfil->imagen)
                        
                        <div class="mt-4">
                            <p>Imagen actuak</p>
                            <img class="img-thumbnail" src="/storage/{{$perfil->imagen}}" style="width: 300px" alt="">
                        </div>
                        @error('ingredientes') 
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror

                    @endif
                    
                </div>

                <div class="form-group">
                    <input type="submit" value="Actualizar perfil" class="btn btn-primary">
                </div>


                
            </form>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection