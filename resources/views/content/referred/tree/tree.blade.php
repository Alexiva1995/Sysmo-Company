@extends('layouts/contentLayoutMaster')

@section('title', 'tree')

@include('content.referred.tree.component.tree-css')

@section('content')
<div class="row">
<div class="col-9 text-center">
    <div class="padre">
        <ul>
            <li class="baseli px-0"  style="width:100%;">
                <a class="base" href="#">
                    <img src="{{$base->logoarbol}}" alt="{{$base->name}}" title="{{$base->name}}" height="96">
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
</div>
<div class="col-3 mt-5">
    <div class="card" id="tarjeta">
        <img src="{{$base->logoarbol}}" id="#imagen" width="150px" height="150px" class="mx-auto">
        <div class="card-body">
          <h5 class="card-title">Nombre</h5>
          <ul class="list-group list-group-flush">
            {{-- <li class="list-group-item">Paquete</li> --}}
            <li class="list-group-item" id="estado">Estado</li>
          </ul>
        </div>
        <div class="card-footer">
            <a href="" id="ver_arbol" class="btn btn-success btn-block disabled">Ver Árbol</a>
        </div>
      </div>
</div>
@endsection


<script> 
    function referred(id, type) {
        let ruta = "{{url('user/referred')}}/" + type + '/' + id
        window.location.href = ruta
    }
    
    function copyReferralsLink() {
        let copyText = $('#referrals_link').attr('data-link');
        const textArea = document.createElement('textarea');
        textArea.textContent = copyText;
        document.body.append(textArea);
        textArea.select();
        document.execCommand("copy");
        textArea.remove();
    }

    function tarjeta(data, url){
        console.log(url);
            //console.log('assets/img/sistema/favicon.png');
            $('.card-title').text("Nombre: " + data.firstname);
            if(data.profile_photo_url == null){
                $('#imagen').attr('src', data.logoarbol );   
            }else{
                $('#imagen').attr('src', data.profile_photo_url);    
            }
            if(url != "" || url != null){
                $('#ver_arbol').attr('href', url);
                $('#ver_arbol').removeClass('disabled');
            }else{
                $('#ver_arbol').addClass('disabled');
            }
            // $('#inversion').text(data.inversion);
            if(data.status == 0){
                $('#estado').html('<li>Estado: <span class="badge badge-warning">Inactivo</span></li>');
            }else if(data.status == 1){
                $('#estado').html('<li>Estado: <span class="badge badge-success">Activo</span></li>');
            }else if(data.status == 2){
                $('#estado').html('<li>Estado: <span class="badge badge-danger">Espanminado</li>');
            }
            
            // $('#tarjeta').removeClass('d-none');
        }

</script>
