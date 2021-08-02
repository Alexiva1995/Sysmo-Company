<!-- MODAL PARA RETIRAR SALDO DISPONILE -->

<div class="modal fade" id="modalSaldoDisponible" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-dark" id="exampleModalLabel">Retiro</h5>
            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="GET" action="{{ route('wallet.paypending') }}">
            @csrf 
     
            <div class="modal-body text-center">
               
                <div class="row">
                    <div class="col-12 mb-1">
                        <div class="row mb-0 justify-content-center" style="font-size: 1.5em;">
                            <div class="col-3">
                                <label for="" class="col font-weight-bold text-dark mr-3">Monto:</label>
                            </div>
                            <div class="col-8">
                                 <input disabled style="backoground: #5f5f5f5f;" class="col form-control w-50 d-inline" id="monto" type="text" value="{{ number_format(($total),2) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-1">

                        <div class="row mb-0 justify-content-center" style="font-size: 1.5em;">
                            <div class="col-3">
                                <label for="" class="col font-weight-bold text-dark mr-3">Fee:</label>
                            </div>
                            <div class="col-8">
                                 <input disabled style="backoground: #5f5f5f5f;" class="col form-control w-50 d-inline" type="text" value="{{ number_format(floatval($total) * 0,2) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <div class="row mb-0 justify-content-center" style="font-size: 1.5em;">
                            <div class="col-3">
                                <label for="" class="col font-weight-bold text-dark mr-3">A recibir:</label>
                            </div>
                            <div class="col-8">
                                <input disabled style="backoground: #5f5f5f5f;" class="form-control w-50 d-inline" type="text" value="{{ number_format(floatval($total) - floatval($total) * 0,2) }}">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn  btn-primary @if($total < 1) disabled @endif">Retirar</button>
            </div>
        </form>
    </div>
    </div>
</div>

<script>
    let monto = $("#monto").val();
    if(monto < 1){
        $('#modalSaldoDisponible').find('button[type="submit"]').prop('disabled',true);
    }
</script>