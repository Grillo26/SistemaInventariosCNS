<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Mesa') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createMesa")
            {{ __('Complete los siguientes datos para registrar una nueva producción. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateMesa")
            {{ __('Complete los siguientes datos para editar la producción que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Nombre-->
                <div class="">
                    <x-jet-label for="nombre_unidad" value="{{ __('Número Mesa') }}" />
                    @if($action == "updateMesa")
                    <small>Edite el Nombre de la Unidad</small>
                    @endif
                    @if($action == "createMesa")
                    <small>Ingrese el Nombre de la Unidad</small>
                    @endif
                    <x-jet-input id="n_mesa" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="mesa.n_mesa" required/>
                    <x-jet-input-error for="mesa.n_mesa" class="mt-2" />
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