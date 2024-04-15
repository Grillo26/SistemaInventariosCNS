<div>
	<x-slot name="header_content">
		<h1>{{ __('Gestionar Salidas') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Información</a></div>
			<div class="breadcrumb-item"><a href="{{ route('salidas') }}">Gestionar Salidas</a></div>
		</div>
	</x-slot>

    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">
		<!--Butons-->
		<div class="flex pb-4 -ml-3">
			<a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
                Registrar Salida
                <span class="fas fa-plus"></span> 
            </a>
			<a href="{{ route('reporte.salidas')}}" class="ml-2 btn btn-success shadow-none">
                Generar Reporte
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
                                        <option value="{{ $producto->id}}"> {{$producto->codigo_producto}}</option>
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

                        <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model="fecha_salida" required>
                    </div>

                </div>
<!--#################################################################################################-->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 mb-3">
                    
                    <!--Observacion-->
                    <div class="col-span-4 p-1">
                        <x-jet-label for="obs" value="{{ __('Observación de Salida') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-text-width"></i>
                                </div>
                            </div>
                            <input id="obs" type="text" class="form-control phone-number" wire:model.defer="obs">
                        </div>
                        
                        <x-jet-input-error for="obs" class="mt-2" />
                    </div>

                    <!--Proveedor -->
                    <div class="col-span-2 p-1">
                        <x-jet-label for="codigo_producto" value="{{ __('Seleccione Proveedor') }}" />
                        
                        <div class="input-group" wire:ignore >
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <select wire:model="nombre_proveedor" class="form-control select2" id="proveedor">
                                    <option value=""> </option>
                                    @foreach($proveedores as $proveedor)
                                        @foreach($proveedors as $prov)
                                            @if($proveedor->proveedor_idProveedor == $prov->id)
                                                <option value="{{ $proveedor->proveedor_idProveedor }}">{{ $prov->nombre_proveedor}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <script>
                            document.addEventListener('livewire:load', function(){
                                $('.proveedor').select2(); // Inicializar Select2 después de que Livewire haya completado las actualizaciones
                                $('#proveedor').on('change', function(){
                                    @this.set('nombre_proveedor', this.value); //Conecta con la variable en el controlador
                                });
                            });
                    </script>
                </div>

<!--#################################################################################################-->
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <!--Pasillo -->
                    <div class="p-1">
                        <x-jet-label for="pasillo" value="{{ __('Pasillo') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-thumbtack"></i>
                                </div>
                            </div>
                            <input id="pasillo_idPasillo" type="text" class="form-control phone-number" wire:model.defer="pasillo_idPasillo" disabled>
                           
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

                    <!-- Campo de entrada para mostrar el número de lote -->
                    <div class="form-group col-span-1 p-1">
                        <label for="n_lote">N° Comprobante</label>
                        <input type="text" id="n_lote" name="n_lote" class="form-control" wire:model="n_lote" disabled>
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

                    <!--Cantidad Stock Salida -->
                    <div class="p-1">
                        <x-jet-label for="cantidad_salida" value="{{ __('Cantidad de Salida') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-arrow-left"></i>
                                </div>
                            </div>
                            <input id="cantidad_salida" type="number" class="form-control phone-number" wire:model="cantidad_salida" 
                            wire:change="$emit('calcular')" >
                        </div>
                        <x-jet-input-error for="cantidad_salida" class="mt-2" />
                    </div>

                    <!--Cantidad Stock disponible-->
                    <div class="p-1">
                        <x-jet-label for="cantidad_stockTotal" value="{{ __('Stock Total') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            </div>
                            <input id="cantidad_stockTotal" type="number" class="form-control phone-number" wire:model="cantidad_stockTotal" 
                            wire:change="$emit('calcular')" disabled>
                        </div>
                        <x-jet-input-error for="cantidad_stockTotal" class="mt-2" />
                    </div>
                
                </div>


			</x-slot>
			<x-slot name="footer">
                <x-jet-secondary-button wire:click="limpiarCampos" class="justify-center"> Limpiar</x-jet-danger-button>
				<x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
				<x-jet-danger-button wire:click="closeModal" class="justify-center"> Cancelar</x-jet-danger-button>
			</x-slot>
		</x-jet-dialog-modal>


		<x-notify-message on="saved" type="success" message="Salida de artículo registrado" />
		<x-notify-message on="edit" type="success" message="Salida de artículo modificado correctamente!" />

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
		@if($salidas->count())
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
                            <th class="cursor-pointer" wire:click="order('fecha_salida')" >
                                <a>Fecha Salida
                                @if ($sort == 'fecha_salida')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>

                            <th class="cursor-pointer" wire:click="order('cantidad')" >
                                <a>Cantidad de Salida
                                @if ($sort == 'cantidad')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>

                        
                        <th><a>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($salidas as $salida)
                    <tr x-data="window.__controller.dataTableController({{ $salida->id }})">
                        @foreach ($productos as $producto)
                            @if($salida->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
                            @endif
                        @endforeach
                        
                        @foreach ($productos as $producto)
                            @if($salida->producto_idProducto == $producto->id)
                                <td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach
                        
                        <td>{{ $salida->fecha_salida}}</td>
                        <td>{{ $salida->cantidad}}</td>
                        <td class="whitespace-no-wrap row-action--icon">
                            <a wire:click="editar({{$salida->id}})" role="button" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
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
    @else
    <livewire:unauthorized-message />
    @endrole
</div>

<!--
    <div class="">
            <form action="{{ route('salidas.fecha') }}" method="post">
                @csrf
                <label>Reportes por rango de fecha</label>
                <input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-border"
                    placeholder="Seleccione un rango de fechas">
                <button class="btn btn-primary" type="submit">Generar Pdf</button>
            </form>
        </div>
        <hr>
        <br>
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        flatpickr("#fecha_ingreso", {
            mode: "range",
            dateFormat: "Y-m-d"
        });
    </script>-->