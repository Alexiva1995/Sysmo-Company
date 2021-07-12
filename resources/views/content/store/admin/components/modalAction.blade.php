<!-- Modal -->
<div class="modal fade" id="modalModalSetStatus" tabindex="-1" role="dialog" aria-labelledby="modalModalAccionTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModalAccionTitle" v-text="(StatusProcess == 'reverse') ? 'Reservar Liquidacion' : 'Aprobar Liquidacion'"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('liquidaction.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" :value="OrdersDetails.id">
                    <h5>Usuario: <strong v-text="OrdersDetails.username"></strong></h5>
                    <h5>Total: <strong v-text="OrdersDetails.amount"></strong></h5>


                    <div class="form-group text-center">
                        <button class="btn btn-primary" v-text="(StatusProcess == 'reverse') ? 'Reservar' : 'Aprobar'"></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>