<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Pasillo') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createPasillo")
            {{ __('Complete los siguientes datos para registrar un nuevo pasillo. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updatePasillo")
            {{ __('Complete los siguientes datos para editar el pasillo que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Numero de Pasillo-->
                <div class="col-span-2 p-1">
                    <x-jet-label for="pasillo" value="{{ __('Número de Pasillo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </div>
                        <input id="n_pasillo" type="text" class="form-control phone-number" wire:model.defer="pasillo.n_pasillo" required>
                    </div>
                    <x-jet-input-error for="pasillo.n_pasillo" class="mt-2" />
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