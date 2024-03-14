<div>
	<x-slot name="header_content">
		<h1>{{ __('Gestionar Entradas') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Información</a></div>
			<div class="breadcrumb-item"><a href="{{ route('entradas') }}">Gestionar Entradas</a></div>
		</div>
	</x-slot>

	<div class="p-8 pt-4 mt-2 bg-white">
		<!--Butons-->
		<div class="flex pb-4 -ml-3">
			<a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
                Ingresar Artículo
                <span class="fas fa-plus"></span> 
            </a>
			<a href="#" class="ml-2 btn btn-success shadow-none">
                Exportar
                <span class="fas fa-file-export"></span> 
            </a>
		</div>

		<!--Modal-->
		<x-jet-dialog-modal wire:model="open">
			<x-slot name="title">Ingresar Artículo</x-slot>
			<x-slot name="content">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">

                    <!--Codigo Identificación -->
                    <div class="col-span-1 p-1">
                        <x-jet-label for="codigo_producto" value="{{ __('Código Artículo') }}" />
                        
                        <div class="input-group" wire:ignore>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <select wire:model="codigo_producto" class="form-control select2" id="producto">
                                    <option value=" "> </option>
                                        @foreach($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->codigo_producto}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
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
                    <div class="col-span-3 p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Nombre') }}" />
                        
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
                </div>

<!--#################################################################################################-->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                    

                    <!--Proveedor -->
                    <div class="col-span-1 p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Proveedor') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <select wire:model="grupoId" class="form-control" id="grupo">
                                <option value="">Seleccione Proveedor</option>
                                @foreach($grupos as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                            
                        </div>
                        <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                    </div>
                    <!--Descripción-->
                    <div class="col-span-2 p-1">
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
                    <!--Fecha Adquisición-->
                    <div  class="col-span-1 p-1">
                        <x-jet-label for="fecha" value="{{ __('Fecha Adquisición') }}" />

                        <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model.defer="produccion.fecha" required>
                    </div>
                </div>
<!--#################################################################################################-->
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
                            <select wire:model="grupoId" class="form-control" id="grupo">
                                <option value="">Selecciona un grupo</option>
                                @foreach($grupos as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
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
                            <select wire:model="grupoId" class="form-control" id="grupo">
                                <option value="">Selecciona un grupo</option>
                                @foreach($grupos as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
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
                            <select wire:model="grupoId" class="form-control" id="grupo">
                                <option value="">Selecciona un grupo</option>
                                @foreach($grupos as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                    </div>
                    <!--Fecha Caducidad-->
                    <div  class="col-span-1 p-1">
                        <x-jet-label for="fecha" value="{{ __('Fecha Caducidad') }}" />

                        <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model.defer="produccion.fecha" required>
                    </div>

                </div>


<!--#################################################################################################-->
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
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
                        <x-jet-label for="nombre_producto" value="{{ __('Valor de Artículo') }}" />
                        
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
                    <!--Total -->
                    <div class="p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Total') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <input id="lote" type="text" class="form-control phone-number" wire:model.defer="producto.nombre_producto" disabled>
                        </div>
                        <x-jet-input-error for="producto.nombre_producto" class="mt-2" />
                    </div>
                    
                </div>

<!--#################################################################################################-->
                <x-jet-section-border />
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Grupo-->
                <div class="">
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Grupo') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <input id="grupo" type="text" class="form-control" wire:model.defer="grupo.nombre_grupo" disabled>
                    </div>
                    <x-jet-input-error for="grupo.nombre_grupo" class="mt-2" />
                </div>

                <!--cuenta_a-->
                <div class="">
                    <x-jet-label for="cuenta_idCuenta" value="{{ __('Cuenta') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-list-ol"></i>
                            </div>
                        </div>
                        <input id="grupo" type="text" class="form-control" wire:model.defer="grupo.nombre_grupo" disabled>
                    </div>
                    <!--<x-jet-input id="cuenta_idCuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.cuenta_idCuenta" required />-->
                    <x-jet-input-error for="producto.cuenta_idCuenta" class="mt-2" />
                </div>

                <!--entrada-->
                <div class="">
                    <x-jet-label for="unidad_idUnidad" value="{{ __('Unidad') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <input id="grupo" type="text" class="form-control" wire:model.defer="grupo.nombre_grupo" disabled>
                    </div>
                    <x-jet-input-error for="producto.unidad_idUnidad" class="mt-2" />
                </div>
            </div>


			</x-slot>
			<x-slot name="footer">
				<x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
				<x-jet-danger-button wire:click="$set('open', false)" class="justify-center"> Cancelar</x-jet-danger-button>
			</x-slot>
		</x-jet-dialog-modal>


		<x-notify-message on="saved" type="success" message="Comprobante creado correctamente!" />
		<x-notify-message on="edit" type="success" message="Comprobante modificado correctamente!" />

		<!--Options-->
		<div class="row mb-4">
			<div class="col form-inline">
				Por Páginas: &nbsp;
				<select class="form-control">
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                </select>
			</div>

			<div class="col">
				<input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
			</div>
		</div>

		<!--TABLE-->
		@if($entradas->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th class="cursor-pointer" wire:click="order('n_comprobante')">
								<a>Fecha de Compra
                                @if ($sort == 'fecha_compra')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer" wire:click="order('detalle')" >
                                <a>Hora de Compra
                                @if ($sort == 'horac')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>

                        
                        <th><a>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($entradas as $entrada)
                    <tr x-data="window.__controller.dataTableController({{ $entrada->id }})">
                        <td>{{ $entrada->fecha_compra }}</td>
                        <td>{{ $entrada->horac}}</td>
                        <td class="whitespace-no-wrap row-action--icon">
                            <a wire:click="editar({{$entrada->id}})" role="button" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
								<a x-on:click.prevent="deleteItem" role="button"><i class="fa fa-16px fa-trash text-red-500"></i></a>
								</td>
						</tr>
						@endforeach
						</tbody>
				</table>
			</div>
		</div>
		@else
		<div class="px-6 py-4">
			No se encontro ningún registro
		</div>
		@endif
	</div>
</div>