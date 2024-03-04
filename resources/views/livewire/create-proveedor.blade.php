<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Proveedor') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createProveedor")
            {{ __('Complete los siguientes datos para registrar un nuevo proveedor. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateProveedor")
            {{ __('Complete los siguientes datos para editar el proveedor que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Nombre-->
                <div class="">
                    <x-jet-label for="nombre_proveedor" value="{{ __('Nombre del Proveedor') }}" />
                    @if($action == "updateProveedor")
                    <small>Edite el Nombre del Proveedor</small>
                    
                    @endif
                    @if($action == "createProveedor")
                    <small>Ingrese el Nombre del Proveedor </small>
                    @endif
                    <x-jet-input id="nombre_proveedor" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="proveedor.nombre_proveedor" required/>
                    <x-jet-input-error for="proveedor.nombre_proveedor" class="mt-2" />
                </div>
                <!--Correo-->
                <div class="">
                    <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                    @if($action == "updateProveedor")
                    <small>Edite el Correo Electrónico del Proveedor</small>
                    
                    @endif
                    @if($action == "createProveedor")
                    <small>Ingrese el Correo Electrónico del Proveedor</small>
                    @endif
                    <x-jet-input id="email" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="proveedor.email" required/>
                    <x-jet-input-error for="proveedor.email" class="mt-2" />
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