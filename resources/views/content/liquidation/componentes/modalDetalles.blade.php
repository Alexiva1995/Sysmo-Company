<!-- Modal -->
<div class="modal fade" id="modalModalDetalles" tabindex="-1" role="dialog" aria-labelledby="modalModalDetallesTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModalDetallesTitle">Detalles de commissions del usuario (@{{CommissionsDetails.username}})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('liquidaction.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" :value="CommissionsDetails.user_id">
                    <table class="table nowrap scroll-horizontal-vertical table-striped" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                @if ($all)
                                <th> 
                                    <button type="button" class="btn" :class="(seleAllComision) ? 'btn-danger' : 'btn-info'" v-on:click="seleAllComision = !seleAllComision">
                                        <i class="fa" :class="(seleAllComision) ? 'fa-square-o' : 'fa-check-square'"></i>
                                    </button>
                                </th>
                                @endif
                                <th>ID Comision</th>
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>Billetera</th>
                                <th>ID Referido</th>
                                <th>Referido</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in CommissionsDetails.commissions" class="text-center">
                                @if ($all)
                                <td>
                                    <input type="checkbox" :value="item.id" :checked="(seleAllComision) ? true : false" name="listCommissions[]">
                                </td>
                                @endif
                                <td v-text="item.id"></td>
                                <td v-text="item.date"></td>
                                <td v-text="item.description"></td>
                                <td v-text="CommissionsDetails.billetera"></td>
                                <td v-text="item.referred_id"></td>
                                <td v-text="item.referred.username"></td>
                                <td v-text="item.amount +' $'"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr> 
                                <th colspan="5" class="text-right">Total Comision</th>
                                <th colspan="2" v-text="CommissionsDetails.total+' $'" class="text-right"></th>
                            </tr>
                        </tfoot>
                    </table>
                    @if ($all)
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Generar Liquidacion</button>
                    </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>