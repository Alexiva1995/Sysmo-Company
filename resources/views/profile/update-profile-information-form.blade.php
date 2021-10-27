<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información de Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Mantenga la información de su perfil actualizada') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-12 row flex-column align-items-center">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Foto') }}" />

                <!-- Current Profile Photo -->
            @if (Auth::user()->profile_photo_path != NULL)
            <div class="mt-0" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="rounded-full h-20 w-20 object-cover">
            </div>
            @else
            <div class="mt-0" x-show="! photoPreview">
                <img src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->username }}"
                    alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>
            @endif

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleccione una nueva foto') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif
        {{-- {{dd($this->user)}} --}}
        <!-- username -->
        <div class="row">
        <div class="col-sm-12 col-md-6 my-1">
            <x-jet-label for="username" value="{{ __('Nombre de usuario') }}" />
            <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
            <x-jet-input-error for="username" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-sm-12 col-md-6 my-1">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- whatsapp -->
        <div class="col-sm-12 col-md-6 my-1">
            <x-jet-label for="whatsapp" value="{{ __('whatsapp') }}" />
            <x-jet-input id="whatsapp" type="text" class="mt-1 block w-full" wire:model.defer="state.whatsapp" />
            <x-jet-input-error for="whatsapp" class="mt-2" />
        </div>


        <!-- billetera -->
        <div class="col-sm-12 col-md-6 my-1">
            <x-jet-label for="select-billetera" value="{{ __('Método de pago') }}" />
            <select id="select-billetera" class="mt-1 block w-full">
                <option value="">--Selecciona una billetera--</option>
                <option value="skrill">Skrill</option>
                {{-- <option value="wallet">Wallet</option> --}}
            </select>
            
            <x-jet-input id="billetera" type="text" class="mt-1 block w-full d-none" placeholder="Ingrese su Billetera" wire:model.defer="state.billetera" />
            <x-jet-input-error for="billetera" class="mt-2" />

            <x-jet-input id="skrill" type="text" class="mt-1 block w-full d-none" placeholder="Ingrese su Skrill" wire:model.defer="state.skrill" />
            <x-jet-input-error for="skrill" class="mt-2" />
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function(){
                let selectBilletera = document.querySelector("#select-billetera"),
                    skrill = document.querySelector("#skrill"),
                    billetera = document.querySelector("#billetera");
                selectBilletera.addEventListener('change', selectBil);
                function selectBil(){
                    if(selectBilletera.value == 'skrill'){
                        skrill.classList.remove('d-none');
                        billetera.classList.add('d-none');
                    }else if(selectBilletera.value == 'wallet'){
                        billetera.classList.remove('d-none');
                        skrill.classList.add('d-none');
                    }else{
                        billetera.classList.add('d-none');
                        skrill.classList.add('d-none');
                    }
                }
            })
        </script>

        <!-- role -->
        <div class="col-sm-12 col-md-6 my-1">
            <x-jet-label for="role" value="{{ __('role') }}" />
            <select id="role" type="number" class="mt-1 block w-full" wire:model.defer="state.role" >
                <option value="0" @if(Auth::user()->role == '0') selected  @endif>Normal</option>
                <option value="1" @if(Auth::user()->role == '1') selected  @endif>Administrador</option>
        </select>
            <x-jet-input-error for="role" class="mt-2" />
        </div>

          <!-- status -->
          <div class="col-sm-12 col-md-6 my-1">
            <x-jet-label for="status" value="{{ __('status') }}" />
            <select id="status" type="number" class="mt-1 block w-full" wire:model.defer="state.status" >
                <option value="0" @if(Auth::user()->status == '0') selected  @endif>Inactivo</option>
                <option value="1" @if(Auth::user()->status == '1') selected  @endif>Activo</option>
        </select>
            <x-jet-input-error for="status" class="mt-2" />
        </div>
    </div>
        
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Cambios Guardados Exitosamente.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
