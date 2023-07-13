<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Cuenta') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createCuenta")
            {{ __('Complete los siguientes datos para registrar una nueva cuenta. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateCuenta")
            {{ __('Complete los siguientes datos para editar la cuenta que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
             <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Nombre-->
                <div class="">
                    <x-jet-label for="nombre_cuenta" value="{{ __('Nombre Cuenta') }}" />
                    @if($action == "updateCuenta")
                    <small>Edite el Nombre de la Cuenta</small>
                    @endif
                    @if($action == "createCuenta")
                    <small>Ingrese el Nombre de la Cuenta</small>
                    @endif
                    <x-jet-input id="nombre_cuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="cuenta.nombre_cuenta" required/>
                    <x-jet-input-error for="cuenta.nombre_cuenta" class="mt-2" />
                </div>

                <!--Grupo-->
                <div class="">
                    <x-jet-label for="codigo_cuenta" value="{{ __('Codigo Cuenta') }}" />
                    @if($action == "updateCuenta")
                    <small>Edite el número del código de la Cuenta</small>
                    @endif
                    @if($action == "createCuenta")
                    <small>Ingrese número del código de la Cuenta</small>
                    @endif
                    <x-jet-input id="codigo_cuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="cuenta.codigo_cuenta" required/>
                    <x-jet-input-error for="cuenta.codigo_cuenta" class="mt-2" />
                </div>

            </div>

        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>