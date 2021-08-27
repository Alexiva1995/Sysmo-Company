@extends('layouts/contentLayoutMaster')

@section('title', 'Flujo de Ganancia')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/additional/data-tables/dataTables.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
    <div class="card col-12">

        <div class="row match-height">
            
            <div class="col-md-4 col-12 mt-2">
                <div class="card btn-warning text-center mx-2">
                    <p class="card-title my-2">Ganancia Total</p>
                    <span id="gananciatotal" class="font-large-2 font-weight-bolder">{{number_format($ordenes-$comision,2,".",",")}}</span>
                </div>
            </div>
            
            <div class="col-md-4 col-12 mt-2">
                <div class="card btn-primary text-center mx-2">
                    <p class="card-title my-2">Ingresos</p>
                    <span id="ingresos" class="font-large-1 font-weight-bold">{{number_format($ordenes,2,".",",")}}</span>
                </div>
            </div>

            <div class="col-md-4 col-12 mt-2">
                <div class="card btn-primary text-center mx-2">
                    <p class="card-title my-2">Comisión</p>
                    <span id="comision" class="font-large-1 font-weight-bold">{{number_format($comision, 2, ".",",")}}</span>
                </div>
            </div>

        </div>
        <h1 id="message"></h1>
        <div class="card-content my-1">
            <div class="card-title text-center">
                <h3>Seleccione el rango de fechas que quiere consultar</h3>
            </div>
            <div class="card-body card-dashboard">
                <div class="row justify-content-center">
                    <div class="d-flex flex-column w-25 px-2 align-items-center">
                        <input type="text" id="fechaDatos" class="form-control flatpickr-basic flatpickr-input active" placeholder="Seleccione la fecha final" readonly="readonly">
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
        let gananciatotal = document.querySelector("#gananciatotal");
        let ingresos = document.querySelector("#ingresos");
        let comision = document.querySelector("#comision");
        flatpickr("#fechaDatos", {
            mode: "range",
            onClose: function(selectedDates, dateStr, instance){
                let fecha = dateStr;
                if(fecha.length >10){
                    from = fecha.substr(0,10);
                    to = fecha.substr(14);
                }else{
                    from = fecha;
                    to = fecha;
                }
                let url = `rangofecha/${from}/${to}`;
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                        },
                    method: 'get',
                })
                .then( response => response.text() )
                .then( resultText => (
                    data = JSON.parse(resultText),
                    gananciatotal.innerHTML = number_format(data[0]-data[1],2,".",","),
                    ingresos.innerHTML = number_format( data[0],2,".",","),
                    comision.innerHTML = number_format( data[1],2,".",",")

                ))
                .catch(function(error) {
                    console.log(error);
                });
            }
        });

    });

    function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        toFixedFix = function (n, prec) {
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            var k = Math.pow(10, prec);
            return Math.round(n * k) / k;
        },
        s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

</script>
@endsection
