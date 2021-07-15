@extends('layouts/contentLayoutMaster')

@section('title', 'Pedidos')

@section('page-script')

<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
<script src="{{asset('assets/js/liquidation.js')}}"></script>


<script src="{{ asset('js/additional/data-tables/dataTables.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#mytable').DataTable({
            // dom: 'flBrtip',
            responsive: true,
            searching: false,
            ordering: true,
            paging: true,
            select: true,
        });
    });

</script>
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <h1 class="content-header-title float-left mr-2">Sysmo Company</h1>
                        <li class="breadcrumb-item"><a href="#">Pedidos</a></li>
                        <li class="breadcrumb-item"><a href="#">Listado de pedidos</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="settlement">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive"> 
                        <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped"
                            data-order='[[ 0, "desc" ]]' data-page-length='10'>
                            <thead class="bg-purple-alt2">

                                <tr class="text-center text-dark">
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($store as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id}}</td>                                    
                                    <td>{{ $item->getProduct->name}}</td>
                                    <td>{{ $item->getUser->username}}</td>

                                    @if ($item->status == '0')
                                    <td> <a class=" badge badge-info text-white">En Espera</a></td>
                                    @elseif($item->status == '1')
                                    <td> <a class=" badge badge-success text-white">Completado</a></td>
                                    @else
                                    <td> <a class=" badge badge-danger text-white">Cancelado</a></td>
                                    
                                    @endif

                                    <td>{{ $item->created_at}}</td>

                                    <td class="d-flex"> 
                                        <a  onclick="vm_liquidation.setStatusOrder({{$item->id}})" class="btn btn-primary">Ver</a>
                                        
                                        @if ($item->status == '0')
                                        
                                        <form action="{{route('edit-order')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="1">
                                            <input type="submit" class="btn btn-success" value="Completar">
                                        </form>

                                        <form action="{{route('edit-order')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="2">
                                            <input type="submit" class="btn btn-danger" value="Cancelar">
                                        </form>
                                        
                                        @elseif ($item->status == '1')

                                        <form action="{{route('edit-order')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="0">
                                            <input type="submit" class="btn btn-info" value="En Espera">
                                        </form>

                                        <form action="{{route('edit-order')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="2">
                                            <input type="submit" class="btn btn-danger" value="Cancelar">
                                        </form>

                                        
                                        @else

                                        <form action="{{route('edit-order')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="1">
                                            <input type="submit" class="btn btn-success" value="Completar">
                                        </form>

                                        <form action="{{route('edit-order')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="0">
                                            <input type="submit" class="btn btn-info" value="En Espera">
                                        </form>
                                        @endif
                                        {{-- <a v-if="CommissionsDetails.order_status == 1" class="btn btn-primary">Ver</a> --}}
                                        
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('content.store.admin.components.modalAction', ['all' => true])
</div>
@endsection
