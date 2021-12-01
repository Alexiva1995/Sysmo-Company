@extends('layouts/contentLayoutMaster')

@section('title', 'Store')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/custom-store.css') }}">
@endsection

@section('content')

<section id="columns">
    <div class="card col-12">
        <h1 class="text-dark texto-card-2 p-2">Elige tu membresía</h1>
        <h2 class="text-dark texto-card-1 p-2">Conviértete en miembro de la cripto academia y comienza el viaje hacia el éxito </h2>
        <div class="card-body row">
            @foreach ( $store as $key => $item )
            @if ($item->status == 1)
            <div class="col-md-6 col-12">
                <div class="card border member membercolor{{$key+1}}">
                    <div>
                        <h1 class="text-white nombre">{{$item->name}}</h1>
                        {{-- <h2 class="text-white academia">Academia</h2> --}}
                        <div class="separador"></div>
                    </div>
                    
                    <h2 class="text-white precio">Precio 
                        <span class="text-white cantidad">{{$item->price}}$</span>
                    </h2>
                    {{-- <h2 class="text-white incluye">Incluye el servicio por un mes</h2> --}}
                </div>
                <a class="btn btn-outline-success border-radius-30 btn-block text-dark py-2 texto-card-1" 
                data-toggle="modal" data-target="#modalCompra{{$item->id}}"
                > Comprar</a>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="modalCompra{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Método de pago</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{route('store.buyProduct')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <h3 class="title py-1 text-center">Seleccione el método de pago</h3>
                                <div class="d-flex justify-content-center">                              
                                <div class="form-check px-2">
                                    <input type="hidden" value="{{$item->id}}" name="idProduct">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="paypal" value="paypal" checked>
                                    <label class="form-check-label" for="paypal">
                                     PayPal
                                    </label>
                                  </div>
                                  <div class="form-check px-2">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="coinbase" value="coinbase">
                                    <label class="form-check-label" for="coinbase">
                                      CoinBase
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Comprar</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
            </div>
            @endif
            @endforeach

            <!-- Button trigger modal -->

                <div class="col-md-6 col-12 mx-auto my-2">
                    <div class="card border member membercolor1">
                        <div>
                            <h1 class="text-white nombre">Plan de Trading</h1>
                            {{-- <h2 class="text-white academia">Academia</h2> --}}
                            <div class="separador"></div>
                        </div>
                        
                        <h2 class="text-white precio">
                            <span class="text-white cantidad">GRATIS</span>
                        </h2>
                        <h2 class="text-white incluye"></h2>
                    </div>
                    <a class="btn btn-outline-success border-radius-30 btn-block text-dark py-2 texto-card-1" target="_blank" href="https://docs.google.com/file/d/1QntDNkDv-zbwMUTeaN8k0WfOoHug5Kij/edit?usp=docslist_api&filetype=msword"> Obtener</a>
                
                </div>
        </div>
    </div>

</section>

@endsection

@section('page-script')

@endsection