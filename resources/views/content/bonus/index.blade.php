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
    <div class="card col-12">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">

                    <!-- Carta de Money Bonus -->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center">
                            <img src="{{asset('images/Bonus/bonus.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoMoney)
                            <div class="bg-green-500 flex justify-center content-center">
                                <div class="text-sm font-semibold text-gray-900">Bono Obtenido</div>
                            </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center mb-1">
                            <div class="font-bold text-gray-900 text-xl py-1">Money Bonus</div>
                        </div>
                        <div class="px-1 pb-2">
                            <p class="text-gray-700 text-base">
                                <strong>Descripción: </strong>Por cada 10 referidos directos que compren algún paquete, usted ganará 100USD
                            </p>
                            <br>
                            @if($bonoMoney)
                                <p class="text-gray-700 text-base">
                                    <strong></strong> Has ganado este bono {{$bonoMoney}} veces <br>
                                    <strong>Progreso: </strong> {{$bonoDinero}} <br>
                                </p> 
                            @else
                                <p class="text-gray-700 text-base">
                                    <strong>Progreso: </strong> {{$bonoDinero}} <br>     
                                </p>
                            @endif 
                        </div>
                    </div>


                    <!-- Carta de speed Bonus -->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center">
                            <img src="{{asset('images/Bonus/speed.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoRapido)
                        <div class="bg-green-500 flex justify-center content-center">
                            <div class="text-sm font-semibold text-gray-900">Bono Obtenido</div>
                        </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center mb-1">
                            <div class="font-bold text-gray-900 text-xl py-1">Speed Bonus</div>
                        </div>                            
                        <div class="px-1 pb-2">
                            <p class="text-gray-700 text-base">
                            <strong>Descripcion: </strong>
                            Si en los primeros 30 días después de su ingreso tiene 20 referidos, se le dará como bono el retorno del 100% de los próximos 2 referidos
                            </p>
                            <p class="text-gray-700 text-base">
                            <strong>Nota: </strong>
                            Para aplicar a este bono debe tener esos 2 referidos en los siguientes 15 días
                            </p>
                            <br>
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> {{$bonoSpeed}}
                            </p>
                        </div>
                    </div>


                    <!-- Carta de Start Bonus -->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center my-1" style="padding-bottom:9px;">
                            <img src="{{asset('images/Bonus/start.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoInicio2)
                        <div class="bg-green-500 flex justify-center content-center">
                            <div class="text-sm font-semibold text-gray-900">Bono Obtenido</div>
                        </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center">
                            <div class="font-bold text-gray-900 text-xl py-1">Start Bonus</div>
                        </div>                            
                        <div class="px-1 pb-2">
                            <p class="text-gray-700 text-base">
                            <strong>Descripcion: </strong>
                            Si obtiene 3 referidos en los primeros 15 días de su ingreso a SYSMO, recibirá por su 4 referido un bono extra de 50USD                                
                            </p>
                            <p class="text-gray-700 text-base">
                            <strong>Nota: </strong>
                            Para aplicar a esta comisión extra, el referido #4 debe traerlo durante los primeros 30 días                                
                            </p> 
                            <br>
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> {{$bonoInicio}}
                            </p>                               
                        </div>
                    </div>  


                    <!-- Carta de Direct Bonus -->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center">
                            <img src="{{asset('images/Bonus/direct.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoDirecto)
                            <div class="bg-green-500 flex justify-center content-center">
                                <div class="text-sm font-semibold text-gray-900">{{$bonoDirecto}} Bonos Obtenidos</div>
                            </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center mb-1">
                            <div class="font-bold text-gray-900 text-xl py-1">Direct Bonus</div>
                        </div>
                        <div class="px-1 pb-2">                                
                            <p class="text-gray-700 text-base">
                            <strong>Descripcion: </strong>
                            El bono directo será cada paquete RS pagará 50USD y cada PRO pagara 70USD
                            </p>
                            <p class="text-gray-700 text-base">
                            <strong>Nota: </strong>
                            Los planes tendran vigencia durante 12 meses                                
                            </p>   
                            <br>
                            @if($bonoDirecto)
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> Has ganado este bono {{$bonoDirecto}} veces
                            </p> 
                            @else
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> Aun no has ganado este Bono
                            </p>
                            @endif                            
                        </div>
                    </div>


                    <!-- Carta de Travel Bonus -->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center my-4">
                            <img src="{{asset('images/Bonus/travel.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoViaje)
                            <div class="bg-green-500 flex justify-center content-center">
                                <div class="text-sm font-semibold text-gray-900">Bono Obtenido</div>
                            </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center mb-1">
                            <div class="font-bold text-gray-900 text-xl py-1">Travel Bonus</div>
                        </div>                            
                        <div class="px-1 pb-2">
                            <p class="text-gray-700 text-base">
                            <strong>Descripcion: </strong>
                            Cuando complete los 50 referidos recibirá adicional, un viaje a San Andrés para 1 persona todo incluido, si esos 50 referidos los cumple en los primeros 90 días de su ingreso a SYSMO, el viaje aplicará para 2 personas todo incluido.                                </p>
                            <p class="text-gray-700 text-base">
                            <strong>Nota: </strong>
                            Si el usuario se encuentra fuera de Colombia se le podrá hacer efectivo el valor del viaje. (El viaje tendrá 60 días para ser redimido. Aplica términos y condiciones.)                                
                            </p>  
                            <br>
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> {{$ref}} / 50 referidos
                            </p>                              
                        </div>
                    </div> 


                    <!-- Carta de Motorbike Bonus --> 
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center my-4 pb-1">
                            <img src="{{asset('images/Bonus/moto.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoMoto)
                            <div class="bg-green-500 flex justify-center content-center">
                                <div class="text-sm font-semibold text-gray-900">Bono Obtenido</div>
                            </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center mb-1">
                            <div class="font-bold text-gray-900 text-xl py-1">Motorbike Bonus</div>
                        </div>                            
                        <div class="px-1 pb-2">
                            <p class="text-gray-700 text-base">
                            <strong>Descripcion: </strong>
                            Al sumar 100 referidos, usted recibirá una moto 0 kilómetros.
                            </p>
                            <p class="text-gray-700 text-base">
                            <strong>Nota: </strong>
                            La moto será entregada en los siguientes 60 días después de cumplir con el requisito. Aplica términos y condiciones
                            </p>  
                            <br>
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> {{$ref}} / 100 referidos
                            </p>                              
                        </div>
                    </div>     


                    <!-- Carta de Car Life Style Bonus -->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="flex justify-center">
                            <img src="{{asset('images/Bonus/car.png')}}" class="object-center" width="300" height="300">
                        </div>
                        @if($bonoCarro)
                            <div class="bg-green-500 flex justify-center content-center">
                                <div class="text-sm font-semibold text-gray-900">Bono Obtenido</div>
                            </div> 
                        @endif
                        <div class="bg-gray-100 flex justify-center content-center mb-1">
                            <div class="font-bold text-gray-900 text-xl py-1">Car Life Style Bonus</div>
                        </div>                            
                        <div class="px-1 pb-2">
                            <p class="text-gray-700 text-base">
                            <strong>Descripcion: </strong>
                            Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 
                            </p>
                            <p class="text-gray-700 text-base">
                            <strong>Nota: </strong>
                            El carro será entregado en los siguientes 60 días después de cumplir con el requisito. Aplica términos y condiciones
                            </p>   
                            <br>
                            <p class="text-gray-700 text-base">
                                <strong>Progreso: </strong> {{$ref}} / 500 referidos
                            </p>                             
                        </div>
                    </div>                                                                       
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