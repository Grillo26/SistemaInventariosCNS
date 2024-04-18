<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Grupo') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createGrupo")
            {{ __('Complete los siguientes datos para registrar una nueva producción. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateGrupo")
            {{ __('Complete los siguientes datos para editar la producción que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
             <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Nombre-->
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_grupo" value="{{ __('Nombre de Grupo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <input id="nombre_grupo" type="text" class="form-control phone-number" wire:model.defer="grupo.nombre_grupo" required>
                    </div>
                    <x-jet-input-error for="grupo.nombre_grupo" class="mt-2" />
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