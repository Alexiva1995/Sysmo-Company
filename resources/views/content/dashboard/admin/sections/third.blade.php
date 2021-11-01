<div class="card col-12">
    <h1 class="text-dark texto-card-2 p-2">Ordenes</h1>
    <div class="card-body row">
        {{-- total Ordenes Grafica--}}
        <div class="col-6">
            <div class="card text-center ">
                <div class="card-header d-flex flex-column align-items-center pb-0">
                    <div id="line-chart"></div>
                </div>
            </div>
        </div>
        {{-- Listado de Ordenes --}}
        <div class="col-6">
            <div class="card text-center ">
                <div class="card-header d-flex flex-column align-items-center pb-0">
                    <table class="table nowrap scroll-horizontal-vertical myTable table-striped">
                        <thead>
                            <tr>
                                <th>ID Orden</th>
                                <th>ID Usuario</th>
                                <th>Usuario</th>
                                <th>Monto</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles['listOrdens'] as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->user_id}}</td>
                                <td>{{$item->name_user}}</td>
                                <td>{{$item->amount}} $</td>
                                <td>{{$item->estado}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
