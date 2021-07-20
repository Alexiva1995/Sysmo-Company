@extends('layouts/contentLayoutMaster')

@section('title', 'tree')

@include('content.referred.tree.component.tree-css')

@section('content')
    <div class="padre">
        <div class="card shadow-lg" style="margin-bottom: 0px;" id="tarjeta">
            <div class="card-body p-1">
                <div class="row no-gutters">
                    <div class="col-4">
                        <img class="float-left rounded-circle shadow-lg" id="imagen" src="{{$base->logoarbol}}" width="96" height="96">     
                    </div>
                    <div class="col-8">
                        <div class="ml-1"><span class="font-weight-bold">Nombre:</span><span id="nombre"> {{$base->firstname}} </span></div> 
            
                        <div class="ml-1"><span class="font-weight-bold">Paquete:</span> <span id="inversion"> {{$paquete}} </span></div>

                        <div class="ml-1 mb-1"><span class="font-weight-bold">Estado:</span> <span id="estado">
                        @if ($base->status == 0)
                        <span class="badge badge-warning">Inactivo</span>
                        @else
                        <span class="badge badge-success">Activo</span>
                        @endif    
                        </span></div>

                        <div class="ml-1"><a id="ver_arbol" class="btn btn-primary btn-sm btn-block" href=>Ver arbol</a></div>
                    </div>
                </div>
            </div>
        </div>

        <ul>
            <li class="baseli px-0"  style="width:100%;">
                <a class="base" href="#">
                    <img src="{{$base->logoarbol}}" alt="{{$base->name}}" title="{{$base->name}}" height="82">
                </a>
                {{-- Nivel 1 --}}
                <ul>
                    @foreach ($trees as $child)
                    <li>
                        @include('content.referred.tree.component.subniveles', ['data' => $child])
                        @if (!empty($child->children))
                        {{-- nivel 2 --}}
                        <ul>
                            @foreach ($child->children as $child)
                            <li>
                                @include('content.referred.tree.component.subniveles', ['data' => $child])
                                @if (!empty($child->children))
                                {{-- nivel 3 --}}
                                <ul>
                                    @foreach ($child->children as $child)
                                    <li>
                                        @include('content.referred.tree.component.subniveles', ['data' => $child])
                                        @if (!empty($child->children))
                                        {{-- nivel 4 --}}
                                        <ul>
                                            @foreach ($child->children as $child)
                                            <li>
                                                @include('content.referred.tree.component.subniveles', ['data' => $child])
                                                @if (!empty($child->children))
                                                {{-- nivel 5 --}}
                                                <ul>
                                                    @foreach ($child->children as $child)
                                                    <li>
                                                        @include('content.referred.tree.component.subniveles', ['data' => $child])
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                {{-- fin nivel 5 --}}
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        {{-- fin nivel 4 --}}
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                {{-- fin nivel 3 --}}
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        {{-- fin nivel 2 --}}
                        @endif
                    </li>
                    @endforeach
                </ul>
                {{-- fin nivel 1 --}}
            </li>
        </ul>
    </div>
    @if (Auth::id() != $base->id)
    <div class="col-12 text-center">
        <a class="btn btn-info" href="{{route('tree_type', strtolower($type))}}">Regresar a mi arbol</a>
    </div>
    @endif

    <script type="text/javascript">
    
        function tarjeta(data, url){
            console.log('Data', data);
            $('#nombre').text(" "+ data.firstname );
            // if(data.profile_photo_url == null){
                $('#imagen').attr('src', data.logoarbol );   
            // }else{
            //     $('#imagen').attr('src', data.profile_photo_url);    
            // }
            
            $('#ver_arbol').attr('href', url);
            $('#inversion').text(" "+ data.paquete );
            if(data.status == 0){
                $('#estado').html('<span class="badge badge-warning">Inactivo</span>');
            }else if(data.status == 1){
                $('#estado').html('<span class="badge badge-success">Activo</span>');
            }else if(data.status == 2){
                $('#estado').html('<span class="badge badge-danger">Eliminado</span>');
            }
            
            $('#tarjeta').removeClass('d-none');
        }
    </script>
@endsection
