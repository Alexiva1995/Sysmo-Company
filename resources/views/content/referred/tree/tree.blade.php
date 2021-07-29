@extends('layouts/contentLayoutMaster')

@section('title', 'tree')

{{-- @include('content.referred.tree.component.tree-css') --}}

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/tree.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom-tree.css') }}">
  @endsection

@section('content')
    <div class="padre">
        <div class="card shadow-lg" id="tarjeta">
            <div class="card-body p-1">
                <div class="row no-gutters">
                    <div class="col-4">
                        <img class="float-left rounded-circle shadow-lg" id="imagen" src="{{$base->logoarbol}}" width="96" height="96">     
                    </div>
                    <div class="col-8">
                        <div class="text-dark">
                            <span class="font-weight-normal">Fecha de ingreso:</span>
                            <span class="font-weight-bolder" id="ingreso"> {{ \Carbon\Carbon::parse($base->created_at)->format('d/m/Y')}}</span>
                        </div> 
            
                        <div class="text-dark py-1">
                            <span class="font-weight-normal">Email:</span> 
                            <span class="font-weight-bolder" id="email"> {{$base->email}} </span>
                        </div>

                        <div class="text-dark mb-1">
                            <span class="font-weight-normal">Patrocinador:</span> 
                            <span class="font-weight-bolder" id="patrocinador"> 
                               
                                    {{$referred}}
                            </span>
                            {{-- <span id="estado">
                                @if ($base->status == 0)
                                <span class="badge badge-warning font-weight-bolder">Inactivo</span>
                                @else
                                <span class="badge badge-success font-weight-bolder">Activo</span>
                                @endif    
                            </span> --}}
                        </div>

                    </div>
                    <div class="col-12 my-2">
                        <a id="ver_arbol" class="btn btn-outline-warning btn-block border-radius-30 text-dark font-weight-bolder text-uppercase" href=>Ver arbol</a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="arbol">
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
            let fecha = new Date(data.created_at);
            $('#ingreso').text(" "+ fecha.toLocaleDateString());
            // if(data.profile_photo_url == null){
                $('#imagen').attr('src', data.logoarbol );   
            // }else{
            //     $('#imagen').attr('src', data.profile_photo_url);    
            // }
            
            $('#ver_arbol').attr('href', url);
            $('#email').text(" "+ data.email );
            $('#patrocinador').text(" "+ data.referred[0])
            // if(data.status == 0){
            //     $('#estado').html('<span class="badge badge-warning">Inactivo</span>');
            // }else if(data.status == 1){
            //     $('#estado').html('<span class="badge badge-success">Activo</span>');
            // }else if(data.status == 2){
            //     $('#estado').html('<span class="badge badge-danger">Eliminado</span>');
            // }

            
            $('#tarjeta').removeClass('d-none');
        }
    </script>
@endsection
