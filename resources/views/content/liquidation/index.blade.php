@extends('layouts/contentLayoutMaster')

@section('title', 'Comissions')

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
<div id="settlement">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive"> 
                        <table class="table nowrap scroll-horizontal-vertical myTable table-striped" id='mytable'>
                            <thead class="">
                                <tr class="text-center text-black bg-purple-alt2"> 
                                    {{-- <th> Seleccionar Todo </th>                              --}}
                                    <th>ID Usuario</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Total Comision</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commissions as $comision)
                                    <tr class="text-center">
                                        {{-- <td>
                                            <input type="checkbox" value="item.id" name="listCommissions[]">
                                        </td> --}}
                                        <td>{{$comision->user_id}}</td>
                                        <td>{{$comision->getWalletUser->username}}</td>
                                        <td>{{$comision->getWalletUser->email}}</td>
                                        <td>{{$comision->total}}</td>
                                        <td>{{$comision->getWalletUser->status}}</td>
                                        <td>
                                            <a onclick="vm_liquidation.getDetailComision({{$comision->user_id}})" class="btn btn-info">
                                                Liquidar
                                            </a>
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
    @include('content.liquidation.componentes.modalDetalles', ['all' => true])
</div>
@endsection
