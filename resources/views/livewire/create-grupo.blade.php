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
                <div class="">
                    <x-jet-label for="nombre_grupo" value="{{ __('Nombre Grupo') }}" />
                    @if($action == "updateGrupo")
                    <small>Edite el Nombre del Grupo</small>
                    @endif
                    @if($action == "createGrupo")
                    <small>Ingrese el Nombre del Grupo</small>
                    @endif
                    <x-jet-input id="lote" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="grupo.nombre_grupo" required/>
                    <x-jet-input-error for="grupo.nombre_grupo" class="mt-2" />
                </div>

                <!--Grupo-->
                <div class="">
                    <x-jet-label for="grupo" value="{{ __('Codigo Grupo') }}" />
                    @if($action == "updateGrupo")
                    <small>Edite el número del código del Grupo</small>
                    @endif
                    @if($action == "createGrupo")
                    <small>Ingrese número del código del Grupo</small>
                    @endif
                    <x-jet-input id="grupo" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="grupo.grupo" required/>
                    <x-jet-input-error for="grupo.grupo" class="mt-2" />
                </div>

                <!--cuenta_a-->
                <div class="">
                    <x-jet-label for="cuenta_a" value="{{ __('Cuenta Analítica') }}" />
                    @if($action == "updateGrupo")
                    <small>Edite el la cuenta analítica </small>
                    @endif
                    @if($action == "createGrupo")
                    <small>Ingrese la cuenta analítica</small>
                    @endif
                    <x-jet-input id="cuenta_a" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="grupo.cuenta_a" required />
                    <x-jet-input-error for="grupo.cuenta_a" class="mt-2" />
                </div>

                <!--partida_a-->
                <div class="">
                    <x-jet-label for="partida_a" value="{{ __('Partida Presupuestaria') }}" />
                    @if($action == "updateGrupo")
                    <small>Edite la partida presupuestarias</small>
                    @endif
                    @if($action == "createGrupo")
                    <small>Ingrese la partida presupuestaria</small>
                    @endif
                    <x-jet-input id="partida_a" type="text" class="mt-1 block w- form-control shadow-none"  wire:model.defer="grupo.partida_a" required/>
                    <x-jet-input-error for="grupo.partida_a" class="mt-2" />
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