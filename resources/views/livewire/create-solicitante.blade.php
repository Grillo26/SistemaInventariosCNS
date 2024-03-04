<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Mesa') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createSolicitante")
            {{ __('Complete los siguientes datos para registrar un nuevo solicitante. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateSolicitante")
            {{ __('Complete los siguientes datos para editar el solicitante que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Nombre-->
                <div class="">
                    <x-jet-label for="nombre_u" value="{{ __('Nombre Unidad') }}" />
                    @if($action == "updateSolicitante")
                    <small>Edite el Nombre de la Unidad</small>
                    @endif
                    @if($action == "createSolicitante")
                    <small>Ingrese el Nombre de la Unidad</small>
                    @endif
                    <x-jet-input id="nombre_u" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="solicitante.nombre_u" required/>
                    <x-jet-input-error for="solicitante.nombre_u" class="mt-2" />
                </div>
                <!--Codigo Unidad-->
                <div class="">
                    <x-jet-label for="codigo_u" value="{{ __('Codigo Unidad') }}" />
                    @if($action == "updateSolicitante")
                    <small>Edite el codigo de la Unidad</small>
                    @endif
                    @if($action == "createSolicitante")
                    <small>Ingrese el Codigo de la Unidad</small>
                    @endif
                    <x-jet-input id="codigo_u" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="solicitante.codigo_u" required/>
                    <x-jet-input-error for="solicitante.codigo_u" class="mt-2" />
                </div>
                <!--Codigo Unidad-->
                <div class="">
                    <x-jet-label for="codigo_u2" value="{{ __('Codigo Unidad 2') }}" />
                    @if($action == "updateSolicitante")
                    <small>Edite el codigo de la Unidad</small>
                    @endif
                    @if($action == "createSolicitante")
                    <small>Ingrese el Codigo de la Unidad</small>
                    @endif
                    <x-jet-input id="codigo_u2" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="solicitante.codigo_u2" required/>
                    <x-jet-input-error for="solicitante.codigo_u2" class="mt-2" />
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