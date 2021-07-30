@extends('layouts/contentLayoutMaster')

@section('title', 'Bonos')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/additional/data-tables/dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom-bonus.css') }}">
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

                    @foreach ($bonuses as $key => $bonus)
                    <div class="col-md-12 col-12">
                        <div class="card border member membercolor1">
                            <div>
                                
                                <h1 class="text-white nombre mt-2">{{$bonus->name}}</h1>
                                <div class="separador"></div>
                                <p class="text-white p-2" style="font-size: 9pt; line-height: 1.4;">Descripción: {{$bonus->description}}</p>
                                {{-- <h2 class="text-white academia">Academia</h2> --}}
                            </div>

                            <div class="w-100">
                                @switch($key+1)

                                    {{-- BONO MONEY --}}
                                    @case(1)
                                        <div class="progress w-100 rounded-0" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{$bono['bonoMoney']}}%">{{$bono['bonoMoney']}}%</div>
                                        </div>
                                            
                                            @if($dbBonos['dbBonoMoney']<1)
                                                <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    En Progreso
                                                </div>
                                            @elseif($dbBonos['dbBonoMoney'] == 1) 
                                            <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                {{$dbBonos['dbBonoMoney']}} Bono Obtenido 
                                            </div>
                                            @else
                                            <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                {{$dbBonos['dbBonoMoney']}} Bonos Obtenidos
                                            </div>
                                            @endif 
                                            
                                    @break

                                    {{-- BONO SPEED --}}
                                    @case(2)
                                            @if($dbBonos['dbBonoSpeed']<1)
                                                @if($bono['bonoSpeed'] != 0)
                                                {!! $bono['bonoSpeed'] !!} 
                                                    <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                        En Progreso
                                                    </div>
                                                @else
                                                    <div class="my-1 bg-danger w-100 font-weight-bold h3 text-white text-center mb-2">
                                                        No Obtenido
                                                    </div> 
                                                @endif
                                            @else
                                                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    Bono Obtenido 
                                                </div>
                                            @endif
                                        
                                    @break

                                    {{-- BONO START --}}
                                    @case(3)
                                        @if($dbBonos['dbBonoStart']<1)
                                            @if($bono['bonoStart'] != 0)
                                            {!! $bono['bonoStart'] !!} 
                                                <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    En Progreso
                                                </div>
                                            @else
                                                <div class="my-1 bg-danger w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    No Obtenido
                                                </div> 
                                            @endif
                                        @else
                                            <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                Bono Obtenido 
                                            </div>
                                        @endif
                                    @break

                                    {{-- BONO DIRECT --}}
                                    @case(4)
                                        @if($dbBonos['dbBonoDirect']<1)
                                            <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                En Progreso
                                            </div>
                                        @elseif($dbBonos['dbBonoDirect']==1)
                                            <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                            {{$dbBonos['dbBonoDirect']}}  Bono Obtenido 
                                            </div>
                                        @else
                                            <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                {{$dbBonos['dbBonoDirect']}}  Bonos Obtenidos 
                                            </div>
                                        @endif
                                    @break

                                    {{-- BONO TRAVEL --}}
                                    @case(5)
                                        @if($dbBonos['dbBonoTravel']<1)
                                            @if($bono['bonoTravel'] != 1 && $bono['bonoTravel'] != 2)
                                                {!! $bono['bonoTravel'] !!}
                                            @endif
                                                <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    En Progreso
                                                </div>
                                                
                                        @else
                                            @if($bono['bonoTravel'] == 1)
                                                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    Bono Obtenido 1 persona
                                                </div>
                                            @elseif($bono['bonoTravel'] == 2)
                                                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    Bono Obtenido 2 personas
                                                </div>
                                            @endif
                                        @endif
                                    @break

                                    {{-- BONO MOTO --}}
                                    @case(6)
                                        @if($dbBonos['dbBonoMoto']<1)
                                            @if($bono['bonoMoto'] != 1)
                                                {!! $bono['bonoMoto'] !!}
                                            @endif
                                                <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    En Progreso
                                                </div>
                                                
                                        @else
                                            @if($bono['bonoMoto'] == 1)
                                                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    Bono Obtenido
                                                </div>
                                            @endif
                                        @endif
                                    @break

                                    {{-- BONO CARRO --}}
                                    @case(7)
                                        @if($dbBonos['dbBonoCarro']<1)
                                            @if($bono['bonoCarro'] != 1)
                                                {!! $bono['bonoCarro'] !!}
                                            @endif
                                            <div class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                                                En Progreso
                                            </div>
                                        
                                        @else
                                            @if($bono['bonoCarro'] == 1)
                                                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                                                    Bono Obtenido
                                                </div>
                                            @endif
                                        @endif
                                    @break
                                    
                                @endswitch
                                
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    
                                                                   
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