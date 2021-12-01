<div class="card col-12">
    <h1 class="text-dark texto-card-2 p-2">Premios</h1>
    <div class="card-body row">

        <div class="col-4">
            <button class="card border member membercolor1 mt-5" data-toggle="collapse" data-target="#bonusMoto"
                aria-expanded="false" aria-controls="bonusMoto">
                <div>
                    <h1 class="text-white nombre mt-2">{{$bonuses[4]->name}}</h1>
                    <div class="separador"></div>
                    <p class="text-white p-2" style="font-size: 9pt; line-height: 1.4;">Descripción:
                        {{$bonuses[4]->description}}</p>
                </div>

                <div id="bonusMoto" class="collapse py-2">
                    <h3 class="text-white text-left text-warning font-weight-bold">Estado: </h3>
                    <p class="text-white" style="font-size: 9pt; line-height: 1.4;">Tienes
                        {{ round(count(Auth::user()->childrenActive)) }} / 100 referidos. Te faltan
                        {{100 - count(Auth::user()->childrenActive)}} referidos</p>
                </div>

                <div class="w-100">
                    @if($dbBonos['dbBonoMoto']<1) @if($bono['bonoMoto'] !=1) {!! $bono['bonoMoto'] !!} @endif <div
                        class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                        En Progreso
                </div>
                @else
                @if($bono['bonoMoto'] == 1)
                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                    Bono Obtenido
                </div>
                @endif
                @endif
            </button>
        </div>

        <div class="col-4">
            <button class="card border member membercolor1" data-toggle="collapse" data-target="#bonusTravel"
                aria-expanded="false" aria-controls="bonusTravel">
                <div>
                    <h1 class="text-white nombre mt-2">{{$bonuses[3]->name}}</h1>
                    <div class="separador"></div>
                    <p class="text-white p-2" style="font-size: 9pt; line-height: 1.4;">Descripción:
                        {{$bonuses[3]->description}}</p>
                </div>

                <div id="bonusTravel" class="collapse py-2">
                    <h3 class="text-white text-left text-warning font-weight-bold">Estado: </h3>
                    <p class="text-white" style="font-size: 9pt; line-height: 1.4;">Tienes
                        {{ round(count(Auth::user()->childrenActive)) }} / 50 referidos. Te faltan
                        {{50 - count(Auth::user()->childrenActive)}} referidos</p>
                </div>

                <div class="w-100">
                    @if($dbBonos['dbBonoTravel']<1) @if($bono['bonoTravel'] !=1 && $bono['bonoTravel'] !=2) {!!
                        $bono['bonoTravel'] !!} @endif <div
                        class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
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
            </button>
        </div>

        <div class="col-4">
            <button class="card border member membercolor1 mt-5" data-toggle="collapse" data-target="#bonusCar"
                aria-expanded="false" aria-controls="bonusCar">
                <div>
                    <h1 class="text-white nombre mt-2">{{$bonuses[5]->name}}</h1>
                    <div class="separador"></div>
                    <p class="text-white p-2" style="font-size: 9pt; line-height: 1.4;">Descripción:
                        {{$bonuses[4]->description}}</p>
                </div>

                <div id="bonusCar" class="collapse py-2">
                    <h3 class="text-white text-left text-warning font-weight-bold">Estado: </h3>
                    <p class="text-white" style="font-size: 9pt; line-height: 1.4;">Tienes
                        {{ round(count(Auth::user()->childrenActive)) }} / 500 referidos. Te faltan
                        {{500 - count(Auth::user()->childrenActive)}} referidos</p>
                </div>

                <div class="w-100">
                    @if($dbBonos['dbBonoCarro']<1) @if($bono['bonoCarro'] !=1) {!! $bono['bonoCarro'] !!} @endif <div
                        class="my-1 bg-primary w-100 font-weight-bold h3 text-white text-center mb-2">
                        En Progreso
                </div>
                @else
                @if($bono['bonoCarro'] == 1)
                <div class="my-1 bg-success w-100 font-weight-bold h3 text-white text-center mb-2">
                    Bono Obtenido
                </div>
                @endif
                @endif
            </button>
        </div>
    </div>
</div>
