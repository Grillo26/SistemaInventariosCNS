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

        <link href="path/to/select2.min.css" rel="stylesheet">
        <script src="path/to/select2.min.js"></script>

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
                <div class="">
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Grupo') }}" />
    
                    <!--<x-jet-input id="grupo_idGrupo" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.grupo_idGrupo" required/>-->
                    <div class="input-group" >
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <select class="form-control" wire:model="grupo" id="grupo">
                            <option value="">Selecciona un grupo</option>
                            @foreach($grupos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-input-error for="producto.grupo_idGrupo" class="mt-2" />
                </div>
                <script>
                    document.addEventListener('livewire:load', function() {
                        $('#grupo').select2();

                        // capturamos valores cuando se produce el evento change
                        $('#grupo').on('change', function(e) {
                            var groupId = $('#grupo').select2("id"); // Obtener el ID del grupo seleccionado
                            var groupName = $('#grupo option:selected').text(); // Obtener el nombre del grupo seleccionado

                            @this.set('grupo_idGrupo', groupId) // Establecer el ID del grupo seleccionado mediante Livewire
                            @this.set('nombre_grupo', groupName) // Establecer el ID del grupo seleccionado mediante Livewire
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