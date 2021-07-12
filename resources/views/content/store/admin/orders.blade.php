@extends('layouts/contentLayoutMaster')

@section('title', 'Pedidos')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
<script src="{{asset('assets/js/order.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('css/additional/data-tables/dataTables.min.css')}}">
@endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <h1 class="content-header-title float-left mr-2">Sysmo Company</h1>
                        <li class="breadcrumb-item"><a href="#">Informes</a></li>
                        <li class="breadcrumb-item"><a href="#">Lista de Ordenes</a></li>
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
                            data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="bg-purple-alt2">

                                <tr class="text-center text-dark">
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($store as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id}}</td>                                    
                                    <td>{{ $item->getProduct->name}}</td>
                                    <td>{{ $item->getUser->username}}</td>

                                    @if ($item->status == '0')
                                    <td> <a onclick="vm_order.setStatusOrder({{$item->id}})" class=" badge badge-info text-white">En Espera</a></td>
                                    @else
                                    <td> <a onclick="vm_order.setStatusOrder({{$item->id}})" class=" badge badge-success text-white">Atendido</a></td>
                                    @endif

                                    <td>{{ $item->created_at}}</td>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('content.store.admin.components.modalAction')
</div>



@endsection
{{-- permite llamar a las opciones de las tablas --}}
@section('page-script')


<script>
    $('#Modal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

</script>

<script src="{{ asset('js/additional/data-tables/dataTables.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#mytable').DataTable({
            dom: 'flBrtip',
            responsive: true,
            searching: false,
            ordering: true,
            paging: true,
            select: true,
        });
    });

</script>
@endsection
