@extends('layouts/contentLayoutMaster')

@section('title', 'Bonos')

@section('page-style')
{{-- Page Css files --}}
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
                        <li class="breadcrumb-item"><a href="#">Bonos</a></li>
                        <li class="breadcrumb-item"><a href="#">Bonos del sistema</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="record">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped" data-order='[[ 2, "asc" ]]' data-page-length='10'>
                            <thead class="">
                                <tr class="text-center text-black bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Nombre del bono</th>
                                    <th>Monto</th> 
                                    <th>Fecha</th>
                                </tr>

                            </thead>
                            <tbody>
                            @foreach($bonuses as $bonus)
                                <tr class="text-center">
                                    <td>{{$bonus->id}}</td>
                                    <td>{{$bonus->getWalletUser->username}}</td>
                                    <td>{{$bonus->getWalletUser->email}}</td>
                                    <td>{{$bonus->bonus->name}}</td>
                                    <td>{{$bonus->amount}}</td>
                                    <td>{{date('d-m-Y', strtotime($bonus->created_at))}}</tr>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
{{-- permite llamar a las opciones de las tablas --}}
@section('page-script')

<script src="{{ asset('js/additional/data-tables/dataTables.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#mytable').DataTable({
            //dom: 'flBrtip',
            responsive: true,
            searching: false,
            ordering: true,
            paging: true,
            select: true,
        });
    });
</script>
@endsection