@extends('layouts/contentLayoutMaster')

@section('title', 'Referidos Directos')

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
                        <li class="breadcrumb-item"><a href="#">Referidos</a></li>
                        <li class="breadcrumb-item"><a href="#">Referidos Directos</a></li>
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
                        <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped"
                            data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="bg-purple-alt2">

                                <tr class="text-center text-dark">
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Fecha de Ingreso</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($referred_direct as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id}}</td>
                                    <td>{{ $item->email}}</td>

                                    @if ($item->status == '0')
                                    <td> <a class=" badge badge-danger text-white">Inactivo</a></td>
                                    @else
                                    <td> <a class=" badge badge-success text-white">Activo</a></td>
                                    @endif

                                    <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                                </tr>
                                @endforeach
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
            dom: 'flBrtip',
            responsive: true,
            searching: false,
            ordering: true,
            paging: true,
            select: true,
        });
    });

</script>

<script>
    function copyReferralsLink(){   
        let copyText = $('#referrals_link').attr('data-link');
        const textArea = document.createElement('textarea');
        textArea.textContent = copyText;
        document.body.append(textArea);      
        textArea.select();      
        document.execCommand("copy");    
        textArea.remove();
    }
</script>
@endsection