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
                <div class="col-span-1 p-1">
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

                <!--Fecha Adquisición-->
                <div  class="col-span-1 p-1">
                    <x-jet-label for="fecha" value="{{ __('Fecha') }}" />

                    <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model.defer="produccion.fecha" required>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                <!--Descripción-->
                <div class="col-span-3 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Descripción Artículo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-width"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
                

                <!--Proveedor -->
                <div class="col-span-1 p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Proveedor') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
            </div>

            <x-jet-section-border />


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-3">
                <!--Valor Artículo-->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Valor por Artículo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
                

                <!--Cantidad Stock -->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Cantidad Stock') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>

                <!--Valor de Inventario -->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Valor de Inventario') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
            </div>

            <x-jet-section-border />

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">

                <!--Pasillo -->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Pasillo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
                <!--Estante-->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Estante') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
                <!--Mesa -->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Mesa') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
                <!-- Estado Artículo -->
                <div class="p-1">
                    <x-jet-label for="nombre_producto" value="{{ __('Estado Artículo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                        </div>
                        <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" required>
                    </div>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>
            </div>

            
        
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">

                <!--Grupo-->
                <div class="">
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Grupo') }}" />
    
                    <!--<x-jet-input id="grupo_idGrupo" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.grupo_idGrupo" required/>-->
                    <div class="form-group">
                        <select wire:model="grupoId" class="form-control" id="grupo">
                            <option value="">Selecciona un grupo</option>
                            @foreach($grupos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                        </div>
                    <x-jet-input-error for="producto.grupo_idGrupo" class="mt-2" />
                </div>

                <!--cuenta_a-->
                <div class="">
                    <x-jet-label for="cuenta_idCuenta" value="{{ __('Cuenta') }}" />
                    
                    <x-jet-input id="cuenta_idCuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.cuenta_idCuenta" required />
                    <x-jet-input-error for="producto.cuenta_idCuenta" class="mt-2" />
                </div>

                <!--unidad-->
                <div class="">
                    <x-jet-label for="unidad_idUnidad" value="{{ __('Unidad') }}" />
                    
                    <x-jet-input id="unidad_idUnidad" type="text" class="mt-1 block w- form-control shadow-none"  wire:model.defer="producto.unidad_idUnidad" required/>
                    <x-jet-input-error for="producto.unidad_idUnidad" class="mt-2" />
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