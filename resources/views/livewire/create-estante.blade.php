<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Estante') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createEstante")
            {{ __('Complete los siguientes datos para registrar un nuevo estante. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateEstante")
            {{ __('Complete los siguientes datos para editar el estante que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
             <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Numero-->
                <div class="col-span- p-1">
                    <x-jet-label for="n_estante" value="{{ __('Número de Estante') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </div>
                        <input id="n_estante" type="text" class="form-control phone-number" wire:model.defer="estante.n_estante" required>
                    </div>
                    <x-jet-input-error for="estante.n_estante" class="mt-2" />
                </div>

                <!--Descripcion-->
                <div class="col-span-2 p-1">
                    <x-jet-label for="estante.descripcion" value="{{ __('Descripción') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <input id="descripcion" type="text" class="form-control phone-number" wire:model.defer="estante.descripcion" required>
                    </div>
                    <x-jet-input-error for="estante.descripcion" class="mt-2" />
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