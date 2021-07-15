@extends('layouts/contentLayoutMaster')

@section('title', 'Flujo de Ganancia')

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
                        <li class="breadcrumb-item"><a href="#">Informes</a></li>
                        <li class="breadcrumb-item"><a href="#">Flujo de Ganancia</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="record">
    <div class="col-12">
        <div class="card">

            <div class="row match-height">
                <div class="col-lg-6 col-12">
                    <div class="card mb-0 pb-0">
                        <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Ganancia Total</h4>
                        </div>
                        <div class="card-body mb-0 pb-0">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">{{number_format($comision-$retiro,2,".",",")}}</h1>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="support-trackers-chart"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <p class="card-text mb-50">Comisión</p>
                                    <span class="font-large-1 font-weight-bold">{{number_format($comision, 2, ".",",")}}</span>
                                </div>
                                <div class="text-center">
                                    <p class="card-text mb-50">Retiro</p>
                                    <span class="font-large-1 font-weight-bold">{{number_format($retiro,2,".",",")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-content">
                <div class="card-body card-dashboard">
                        {{-- <h1 href="#" class="btn btn-primary float-right mb-0 waves-effect waves-light">Comisiones sin liquidar: {{$user}}</h1> --}}
                    <div class="table-responsive">
                        <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped" data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="">
                                <tr class="text-center text-dark bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Tipo de Transaccion</th>
                                    <th>Correo del usuario al que pertenece</th>
                                    <th>Monto</th>                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($profit as $val => $item)
                                <tr class="text-center">
                                    <td>{{$item->id}}</td>
                                    @if ($item->type_transaction == '0')
                                    <td> <a class=" badge badge-info text-white">Comision</a></td>
                                    @else
                                    <td> <a class=" badge badge-success text-white">Retiro</a></td>
                                    @endif
                                    <td>{{$correos[$val]}}</td>
                                    <td> {{$item->amount}} </td>
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
