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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-3">
                <!--Nombre-->
                <div class="">
                    <x-jet-label for="nombre_producto" value="{{ __('Nombre') }}" />
                    @if($action == "updateProducto")
                    <small>Edite el Nombre del Artículo</small>
                    @endif
                    @if($action == "createProducto")
                    <small>Intro. Nombre de Artículo</small>
                    @endif
                    <x-jet-input id="lote" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.nombre_producto" required/>
                    <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                </div>

                <!--Codigo-->
                <div class="">
                    <x-jet-label for="codigo_producto" value="{{ __('Codigo Artículo') }}" />
                    @if($action == "updateProducto")
                    <small>Edite el número del código del Artículo</small>
                    @endif
                    @if($action == "createProducto")
                    <small>Intro. Código de Artículo</small>
                    @endif
                    <x-jet-input id="codigo_producto" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.codigo_producto" required/>
                    <x-jet-input-error for="producto.codigo_producto" class="mt-2" />
                </div>
            </div>
        <script>
        // Inicializar Select2 en el campo de selección
        $(document).ready(function() {
            $('#grupo').select2();
        });
        </script>
        

            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">

                <!--Grupo-->
                <div class="">
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Grupo') }}" />
                    @if($action == "updateProducto")
                    <small>Edite el Nombre del Grupo</small>
                    @endif
                    @if($action == "createProducto")
                    <small>Escriba y seleccione Grupo</small>
                    @endif
                    <!--<x-jet-input id="grupo_idGrupo" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.grupo_idGrupo" required/>-->
                    <br>
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
                    @if($action == "updateProducto")
                    <small>Edite el la Cuenta </small>
                    @endif
                    @if($action == "createProducto")
                    <small>Escriba y seleecione Cuenta</small>
                    @endif
                    <x-jet-input id="cuenta_idCuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.cuenta_idCuenta" required />
                    <x-jet-input-error for="producto.cuenta_idCuenta" class="mt-2" />
                </div>

                <!--unidad-->
                <div class="">
                    <x-jet-label for="unidad_idUnidad" value="{{ __('Unidad') }}" />
                    @if($action == "updateProducto")
                    <small>Edite el Grupo</small>
                    @endif
                    @if($action == "createProducto")
                    <small>Escriba y seleccione Unidad</small>
                    @endif
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