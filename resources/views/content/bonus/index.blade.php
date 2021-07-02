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
                        <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped" data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="">

                                <tr class="text-center text-black bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Descripción del premio</th> 
                                    <th>Progreso</th>
                                    <th>Estado</th>
                                </tr>

                            </thead>
                            <tbody>

                            <tr class="text-center">
                                    <td>1</td>
                                    <td>Bono de $50</td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25</div>
                                    </div>
                                    </td>
                                    <td>Recibido</td>                                   
                                </tr>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td>Moto</td>
                                    <td>Barra</td>
                                    <td>No ganado</td>                                   
                                </tr>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td>Carro</td>
                                    <td>Barra</td>
                                    <td>No ganado</td>                                   
                                </tr>

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
