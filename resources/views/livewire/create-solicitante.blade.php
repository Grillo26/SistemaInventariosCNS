<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Crear Nueva Solicitud') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createSolicitante")
            {{ __('Complete los siguientes datos para registrar una nueva Solicitud. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateSolicitante")
            {{ __('Complete los siguientes datos para editar la solicitud que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

        
        <x-slot name="form">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                <!--Referencia o Titulo-->
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Título Solicitud') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <input id="referencia" type="text" class="form-control phone-number" wire:model.defer="solicitante.referencia" required>
                    </div>
                    <x-jet-input-error for="solicitante.referencia" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                <!--Detalle-->
                <div class="col-span-3 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Detalle de Solicitud') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-width"></i>
                            </div>
                        </div>
                        <input id="detalle" type="text" class="form-control phone-number" wire:model.defer="solicitante.detalle" required>
                    </div>
                    <x-jet-input-error for="solicitante.detalle" class="mt-2" />
                </div>

                <!--Cantidad-->
                <div class="col-span-1 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Cantidad') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                        <input id="cantidad" type="number" class="form-control phone-number" wire:model.defer="solicitante.cantidad" required>
                    </div>
                    <x-jet-input-error for="solicitante.cantidad" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">


                @if($action == "updateSolicitante")
                <!--Estado-->
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Estado') }}" />
                    
                    <div class="input-group" wire:ignore>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <select wire:model="solicitante.estado_idEstado" class="form-control " id="estado">
                            <option value="Seleccione Código"> </option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->estado}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                <!--Código Artículo-->
                <div class="col-span-1 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Código Artículo') }}" />
                    
                    <div class="input-group" wire:ignore>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <select wire:model="solicitante.producto_idProducto" class="form-control select2" id="producto">
                            <option value="Seleccione Código"> </option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->codigo_producto}}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-input-error for="codigo_producto" class="mt-2" />
                </div>
                <script>
                    document.addEventListener('livewire:load', function(){ 
                        $('.producto').select2();
                        $('#producto').on('change', function(){
                            @this.set('codigo_producto', this.value); //Conecta con la variable en el controladors
                        });
                    });
                </script>

                <!--Nombre--> 
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Nombre Artículo') }}" />
                        
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <input id="nombre_producto" type="text" class="form-control phone-number" wire:model.defer="nombre_producto" disabled>
                    </div>
                    <x-jet-input-error for="nombre_producto" class="mt-2" />
                </div>

                <!--Disponible-->
                <div class="col-span-1 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Disponible') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-question"></i>
                            </div>
                        </div>
                        <input id="disponible" type="text" class="form-control phone-number" wire:model.defer="solicitante.disponible" disabled>
                    </div>
                    <x-jet-input-error for="solicitante.disponible" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                <!--Nombre Solicitante--> 
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Nombre Solicitante') }}" />
                        
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <input id="solicitante.nombre_solicitante" type="text" class="form-control phone-number" wire:model.defer="solicitante.nombre_solicitante" require>
                    </div>
                    <x-jet-input-error for="solicitante.nombre_solicitante" class="mt-2" />
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