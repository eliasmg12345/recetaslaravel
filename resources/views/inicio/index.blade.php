@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('hero')
    
    <div class="hero-categorias">
        <form action="{{route('buscar.show')}}" class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu proxima comida </p>
                    <input 
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="buscar receta  "
                    />
                </div>
            </div>
        </form>
    </div>

@endsection

@section('content')
    {{--
        MA1 usando el url y el asset
    <img src="{{asset('/images/pollofrito.jpeg')}}" alt="imagen fondo">  
    --}}  
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4 ">Últimos productos</h2>
        <div class="owl-carousel owl-theme">
                @foreach ($nuevas as $nueva)
                <div class="card">
                    <img src="/storage/{{$nueva->imagen}}" class="card-img-top" alt="imagen receta">
                    <div class="card-body">
                        <h3>{{Str::title($nueva->titulo)}}</h3>

                        <p>{{Str::words(strip_tags($nueva->preparacion),10)}}</p>

                        <a href="{{route('recetas.show',['receta'=>$nueva->id])}}"
                            class="btn btn-primary d-block font-weight-bold text-uppercase"
                        >Ver Receta</a>
                    </div>
                </div>
            
                
                @endforeach
        </div>
        
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">recetas mas votadas</h2>
        <div class="row">
            
                @foreach ($votadas as $receta)
                    @include('ui.receta')
                @endforeach
            
        </div>
    </div>

    @foreach ($recetas as $key=>$grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{str_replace('-',' ', $key)}}</h2>
            <div class="row">
                @foreach ($grupo as $recetas)
                    @foreach ($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
    
@endsection