<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Producto') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createProducto")
            {{ __('Complete los siguientes datos para registrar un nuevo Producto. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateProducto")
            {{ __('Complete los siguientes datos para editar el producto que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

        </x-slot>

    

        <x-slot name="form">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                <!--Nombre-->
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Nombre') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-height"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>

                <!--Codigo Identificación -->
                <div class="col-span-2 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Código Artículo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
            </div>

            <x-jet-section-border />

            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Grupo-->
                <div class="" >
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Grupo') }}" />
                    <div class="input-group" wire:ignore>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <select wire:model="nombre_grupo" class="form-control select2"  id="grupo">
                            <option value=" ">Selecciona un grupo</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre_grupo }}</option>
                            @endforeach
    
                        </select>
                        
                    </div>
                </div>
                <script>
                    document.addEventListener('livewire:load', function(){
                        
                        $('.grupo').select2();
                        $('#grupo').on('change', function(){
                            @this.set('idGrupo', this.value); //Conecta con la variable en el controlador
                        });
                    });
                </script>
                
                <!--cuenta_a-->
                <div class="">
                    <x-jet-label for="cuenta_idCuenta" value="{{ __('Cuenta') }}" />

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-list-ol"></i>
                            </div>
                        </div>
                        <select wire:model="grupoId" class="form-control" id="grupo">
                            <option value="">Selecciona un grupo</option>
                            @foreach($grupos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!--<x-jet-input id="cuenta_idCuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.cuenta_idCuenta" required />-->
                    <x-jet-input-error for="producto.cuenta_idCuenta" class="mt-2" />
                </div>

                <!--unidad-->
                <div class="">
                    <x-jet-label for="unidad_idUnidad" value="{{ __('Unidad') }}" />

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <select wire:model="grupoId" class="form-control" id="grupo">
                            <option value="">Selecciona un grupo</option>
                            @foreach($grupos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <!--<x-jet-input id="unidad_idUnidad" type="text" class="mt-1 block w- form-control shadow-none"  wire:model.defer="producto.unidad_idUnidad" required/>-->
                    <x-jet-input-error for="producto.unidad_idUnidad" class="mt-2" />
                </div>
                {{$idGrupo}}
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