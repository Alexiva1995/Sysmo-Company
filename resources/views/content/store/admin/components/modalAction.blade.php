<!-- Modal -->
<div class="modal fade" id="modalModalSetStatus" tabindex="-1" role="dialog" aria-labelledby="modalModalAccionTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center text-2xl text-black">Detalles del Pedido</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                {{-- <form action="{{route('edit-order')}}" method="post"> --}}
                    {{-- @csrf --}}
                    <input type="hidden" name="id" :value="CommissionsDetails.order_id">
                    <input type="hidden" name="status" :value="CommissionsDetails.order_status">
                    
                    <h2 class="mb-1 mt-1 text-center text-xl text-black">USUARIO</h2>
                    <div class="table-responsive"> 
                        <table id="mytable" id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped"
                                data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="bg-purple-alt2">
                                <tr class="text-center text-dark">
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                                <tr class="text-center">
                                    <td><p v-text="CommissionsDetails.user_id"></p></td>
                                    <td><p v-text="CommissionsDetails.username"></p></td>
                                    <td><p v-text="CommissionsDetails.firstname"></p></td>
                                    <td><p v-text="CommissionsDetails.lastname"></p></td>
                                    <td><p v-text="CommissionsDetails.email"></p></td>
                                </tr>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="mb-1 mt-2 text-center text-xl text-black" >PAQUETE</h2>
                    <div class="table-responsive"> 
                        <table id="mytable" id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped"
                                data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="bg-purple-alt2">
                                <tr class="text-center text-dark">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                                <tr class="text-center">
                                    <td><p v-text="CommissionsDetails.product_id"></p></td>
                                    <td><p v-text="CommissionsDetails.product_name"></p></td>
                                    <td><p v-text="CommissionsDetails.product_description"></p></td>
                                    <td><p v-text="CommissionsDetails.product_price"></p></td>
                                </tr>
                            <tbody>
                            </tbody>
                        </table>
                    </div>                    

                    <h2 class="mb-1 mt-2 text-center text-xl text-black">PEDIDO</h2>
                    <div class="table-responsive"> 
                        <table id="mytable" id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped"
                                data-order='[[ 1, "asc" ]]' data-page-length='10'>
                            <thead class="bg-purple-alt2">
                                <tr class="text-center text-dark">
                                    <th>ID</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Cambiar estado</th>
                                </tr>
                            </thead>
                                <tr class="text-center">
                                    <td><p v-text="CommissionsDetails.order_id"></p></td>
                                    <td><p v-text="CommissionsDetails.product_price"></p></td>
                                    <td v-if="CommissionsDetails.order_status == 0"> <a class="badge badge-info text-white">En Espera</a></td>
                                    {{-- <td v-if="CommissionsDetails.order_status == 0"> <button class="btn btn-success">Cambiar a Atendido</a></td> --}}
                                    <td v-if="CommissionsDetails.order_status == 1"> <a class="badge badge-success text-white">Atendida</a></td>
                                    {{-- <td v-if="CommissionsDetails.order_status == 1"> <button class="btn btn-info">Regresar a En Espera</button></td> --}}
                                </tr>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 

                {{-- </form> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>