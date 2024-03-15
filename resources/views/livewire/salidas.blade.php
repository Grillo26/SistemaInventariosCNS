<div>
	<x-slot name="header_content">
		<h1>{{ __('Gestionar Salidas') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Información</a></div>
			<div class="breadcrumb-item"><a href="{{ route('salidas') }}">Gestionar Salidas</a></div>
		</div>
	</x-slot>

	<div class="p-8 pt-4 mt-2 bg-white">
		<!--Butons-->
		<div class="flex pb-4 -ml-3">
			<a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
                Registrar Salida
                <span class="fas fa-plus"></span> 
            </a>
			<a href="#" class="ml-2 btn btn-success shadow-none">
                Exportar
                <span class="fas fa-file-export"></span> 
            </a>
		</div>

		<!--Modal-->
		<x-jet-dialog-modal wire:model="open">
			<x-slot name="title">Registrar Salida</x-slot>
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
                    <div class="col-span-2 p-1">
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
                    <!--Fecha Salida-->
                    <div  class="col-span-1 p-1">
                        <x-jet-label for="fecha" value="{{ __('Fecha Salida') }}" />

                        <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model="fecha_adquisicion" required>
                    </div>

                </div>
<!--#################################################################################################-->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-3">
                    
                    <!--Descripción-->
                    <div class="col-span-2 p-1">
                        <x-jet-label for="descripcion" value="{{ __('Descripción Artículo') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-text-width"></i>
                                </div>
                            </div>
                            <input id="descripcion" type="text" class="form-control phone-number" wire:model.defer="descripcion" disabled>
                        </div>
                        
                        <x-jet-input-error for="descripcion" class="mt-2" />
                    </div>
                    
                </div>

<!--#################################################################################################-->
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <!--Pasillo -->
                    <div class="p-1">
                        <x-jet-label for="pasillo" value="{{ __('Pasillo') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-thumbtack"></i>
                                </div>
                            </div>
                            <input id="pasillo_idPasillo" type="text" class="form-control phone-number" wire:model="pasillo_idPasillo" disabled>
                           
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
                            <input id="estante_idEstante" type="text" class="form-control phone-number" wire:model="estante_idEstante" disabled>

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
                            <input id="mesa_idMesa" type="text" class="form-control phone-number" wire:model="mesa_idMesa" disabled>

                        </div>
                        <x-jet-input-error for="mesa" class="mt-2" />
                    </div>
                    
                </div>

<!--#################################################################################################-->
                <x-jet-section-border />
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <!--Cantidad Stock -->
                    <div class="p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Cantidad Stock Disponible') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            </div>
                            <input id="cantidad" type="number" class="form-control phone-number" wire:model="cantidad" 
                            wire:change="$emit('calcular')" disabled>
                        </div>
                        <x-jet-input-error for="cantidad" class="mt-2" />
                    </div>
                
                </div>


			</x-slot>
			<x-slot name="footer">
                <x-jet-secondary-button wire:click="limpiarCampos" class="justify-center"> Limpiar</x-jet-danger-button>
				<x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
				<x-jet-danger-button wire:click="closeModal" class="justify-center"> Cancelar</x-jet-danger-button>
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
							<th class="cursor-pointer" wire:click="order('producto_idProducto')">
								<a>Código Producto
                                @if ($sort == 'producto_idProducto')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer" wire:click="order('producto_idProducto')">
								<a>Nombre Producto
                                @if ($sort == 'producto_idProducto')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer" wire:click="order('fecha_adquisicion')" >
                                <a>Fecha Ingreso
                                @if ($sort == 'fecha_adquisicion')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer" wire:click="order('fecha_caducidad')" >
                                <a>Fecha Vencimiento
                                @if ($sort == 'fecha_caducidad')
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
                        <td>{{ $entrada->producto_idProducto }}</td>
                        @foreach ($productos as $producto)
                            @if($entrada->producto_idProducto == $producto->id)
                                <td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach
                        
                        <td>{{ $entrada->fecha_adquisicion}}</td>
                        <td>{{ $entrada->fecha_caducidad}}</td>
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