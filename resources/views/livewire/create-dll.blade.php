<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Dll') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createDll")
            {{ __('Complete los siguientes datos para registrar una nueva Dll. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateDll")
            {{ __('Complete los siguientes datos para editar la Dll que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Nombre-->
                <div class="">
                    <x-jet-label for="nombre" value="{{ __('Nombre Dll') }}" />
                    @if($action == "updateDll")
                    <small>Edite el Nombre del Dll</small>
                    @endif
                    @if($action == "createDll")
                    <small>Ingrese el Nombre del Dll</small>
                    @endif
                    <x-jet-input id="nombre" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="dll.nombre" required/>
                    <x-jet-input-error for="dll.nombre" class="mt-2" />
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