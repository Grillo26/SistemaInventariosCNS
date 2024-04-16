<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Artículo') }}

        </x-slot>

        <x-slot name="description">
            @if ($action == "createProducto")
            {{ __('Complete los siguientes datos para registrar un nuevo Artículo. Nota: lea correctamente los campos y verifique  si están escritos de
                manera adecuada dentro del formulario.') }} 
            
            @endif

            @if($action == "updateProducto")
            {{ __('Complete los siguientes datos para editar el Artículo que seleccionó. Nota: lea correctamente los campos y verifique  si están escritos de
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
                    <x-jet-label for="codigo_producto" value="{{ __('Código Artículo') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input id="codigo_producto" type="text" class="form-control phone-number" wire:model.debounce.500ms="codigo_producto" required>
                    </div>
                    <x-jet-input-error for="producto.codigo_producto" class="mt-2" />
                    @if ($codigo_existe)
                    <p class="text-danger">El código que ingresó ya existe.</p>
                    @endif
                </div>
                
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-3">

                <!--Categoria -->
                <div class="col-span-1 p-1">
                    <x-jet-label for="codigo_producto" value="{{ __('Categoría') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                        <select wire:model ="categoria_select" class="form-control">
                            <option value="">Seleccione Categoria</option>
                            @foreach($categorias as $categoria)
                            <option value="{{$categoria->id }}">{{ $categoria->nombre_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!--SUBCATEGORIA-->
                @if(!is_null($subcategorias))
                    <div class="col-span-1 p-1">
                        <x-jet-label for="codigo_producto" value="{{ __('Subcategoría') }}" />
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-question"></i>
                                </div>
                            </div>
                            <select wire:model ="subcategoria_select" class="form-control">
                                <option value="">Seleccione Subcategoria</option>
                                @foreach($subcategorias as $sub)
                                <option value="{{$sub->id }}">{{ $sub->nombre_subcategoria}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif 
            </div>

            <x-jet-section-border />
            <!--UBICACION-->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-3">
                <!--Pasillo -->
                <div class="p-1">
                    <x-jet-label for="pasillo" value="{{ __('Pasillo') }}" />

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                        <select wire:model="pasillo_idPasillo" class="form-control" id="pasillo">
                                            <option value=""></option>
                                            @foreach($pasillos as $pasillo)
                                                <option value="{{ $pasillo->id }}">{{ $pasillo->n_pasillo}}</option>
                                            @endforeach
                                        </select>

                    </div>
                    <x-jet-input-error for="pasillo" class="mt-2" />
                </div>
                <!--Estante-->
                <div class="p-1">
                    <x-jet-label for="estante" value="{{ __('Estante') }}" />

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                        <select wire:model="estante_idEstante" class="form-control" id="estante">
                                            <option value=""></option>
                                            @foreach($estantes as $estante)
                                                <option value="{{ $estante->id }}">{{ $estante->n_estante}}</option>
                                            @endforeach
                                        </select>
                    </div>
                    <x-jet-input-error for="estante" class="mt-2" />
                </div>
                <!--Mesa -->
                <div class="p-1">
                    <x-jet-label for="mesa" value="{{ __('Mesa') }}" />

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                        <select wire:model="mesa_idMesa" class="form-control" id="mesa">
                                            <option value=""></option>
                                            @foreach($mesas as $mesa)
                                                <option value="{{ $mesa->id }}">{{ $mesa->n_mesa}}</option>
                                            @endforeach
                                        </select>
                    </div>
                    <x-jet-input-error for="mesa" class="mt-2" />
                </div>

            </div>
            
            <x-jet-section-border />
            <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--unidad-->
                <div class="">
                    <x-jet-label for="producto.unidad_idUnidad" value="{{ __('Unidad') }}" />

                    <div class="input-group" wire:ignore>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <select wire:model.defer="producto.unidad_idUnidad" class="form-control  select2" id="unidad">
                            <option value=" ">Selecciona Unidad</option>
                            @foreach($unidades as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre_unidad }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="unidad" class="mt-2" />
                    </div>                    
                </div>
                <script>
                    document.addEventListener('livewire:load', function(){
                        
                        $('.unidad').select2();
                        $('#unidad').on('change', function(){
                            @this.set('idUnidad', this.value); //Conecta con la variable en el controladors
                        });
                    });
                </script>
                <!--Grupo-->
                <div class="" >
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Grupo') }}" />
                    <div class="input-group" wire:ignore>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <select wire:model="producto.grupo_idGrupo" class="form-control select2"  id="grupo">
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
                            @this.set('idGrupo', this.value); //Conecta con la variable en el controladors
                        });
                    });
                </script>
                
                <!--cuenta_a-->
                <div class="">
                    <x-jet-label for="cuenta_idCuenta" value="{{ __('Cuenta') }}" />

                    <div class="input-group" wire:ignore>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-list-ol"></i>
                            </div>
                        </div>
                        <select wire:model.defer="producto.cuenta_idCuenta" class="form-control select2"  id="cuenta">
                            <option value=" ">Selecciona un cuenta</option>
                            @foreach($cuentas as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->nombre_cuenta }}</option>
                            @endforeach
    
                        </select>
                    </div>
                </div>
                <script>
                    document.addEventListener('livewire:load', function(){
                        
                        $('.cuenta').select2();
                        $('#cuenta').on('change', function(){
                            @this.set('idCuenta', this.value); //Conecta con la variable en el controladors
                        });
                    });
                </script>

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