@extends('layouts/contentLayoutMaster')

@section('title', 'Billetera')

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
                        <li class="breadcrumb-item"><a href="#">Financiero</a></li>
                        <li class="breadcrumb-item"><a href="#">Billetera</a></li>
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
                        <h1 href="#" class="btn btn-primary float-right mb-0 waves-effect waves-light">Saldo Disponible: {{ $total }}$</h1>
                    <div class="table-responsive">
                        <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                            <thead class="">
                                <tr class="text-center text-dark bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comisiones as $comision)
                                <tr class="text-center">
                                    <td>{{$comision->id}}</td>
                                    <td>{{date('d-m-Y', strtotime($comision->created_at))}}</td>
                                    <td>{{$comision->description}}</td>
                                    <td>{{$comision->amount}}</td>
                                    <td>
                                        @if ($comision->status == 0)
                                            En Espera
                                        @elseif ($comision->status == 2)
                                            Cancelado
                                        @else
                                            Pagado
                                        @endif
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
