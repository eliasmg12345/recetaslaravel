<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{$receta->imagen}}" alt="imagen receta" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{$receta->titulo}}</h3>
            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha=$receta->created_at
                @endphp
                
                <p class="text-primary fecha font-weight-bold">
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>
                <p>{{count($receta->likes)}} Les gusto</p>
            </div>
            <p>{{Str::words(strip_tags($receta->preparacion),20,'...')}}</p>
            <a href="{{route('recetas.show',['receta'=>$receta->id])}}"
                class="btn btn-primary d-block btn-receta"
                >Ver Receta</a>
        </div>
    </div>
</div>