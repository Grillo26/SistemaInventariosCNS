<div>
	<x-slot name="header_content">
		<h1>{{ __('Gestionar Entradas') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Información</a></div>
			<div class="breadcrumb-item"><a href="{{ route('entradas') }}">Gestionar Entradas</a></div>
		</div>
	</x-slot>

    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white bg-gray-100 text-gray-900 tracking-wider leading-normal">
		<!--Butons-->

		<div class="flex pb-4 -ml-3">
			<a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
                Ingresar Artículo
                <span class="fas fa-plus"></span> 
            </a>
			<a href="{{ route('reporte.entradas')}}" class="ml-2 btn btn-success shadow-none">
                Generar Reporte
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
                    <!--Fecha Adquisición-->
                    <div  class="col-span-1 p-1">
                        <x-jet-label for="fecha" value="{{ __('Fecha Adquisición') }}" />

                        <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model="fecha_adquisicion" required>
                    </div>


                </div>

<!--#################################################################################################-->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-5 mb-3">
                    <!--Proveedor -->
                    <div class="col-span-2 p-1">
                        <x-jet-label for="nombre_proveedor" value="{{ __('Proveedor') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                            <select wire:model="nombre_proveedor" class="form-control select2" id="proveedor">
                                <option value=""> </option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_proveedor}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    

                    @push('scripts')
                        <script>
                            document.addEventListener('livewire:load', function(){
                                $('.proveedor').select2(); // Inicializar Select2 después de que Livewire haya completado las actualizaciones
                                $('#proveedor').on('change', function(){
                                    @this.set('nombre_proveedor', this.value); //Conecta con la variable en el controlador
                                });
                            });
                        </script>
                        
                    @endpush
                
                    <!--Descripción-->
                    <div class="col-span-2 p-1">
                        <x-jet-label for="descripcion" value="{{ __('Observación') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-text-width"></i>
                                </div>
                            </div>
                            <input id="descripcion" type="text" class="form-control phone-number" wire:model.defer="descripcion" required>
                        </div>
                        
                        <x-jet-input-error for="descripcion" class="mt-2" />
                    </div>
                    <!-- Campo de entrada para mostrar el número de lote -->
                    <div class="form-group col-span-1 p-1">
                        <label for="n_lote">Número de Lote</label>
                        <input type="text" id="n_lote" name="n_lote" class="form-control" wire:model="n_lote" disabled>
                    </div>
                    
                </div>

<!--#################################################################################################-->
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <!--Cantidad Stock -->
                    <div class="p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Cantidad Stock') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            </div>
                            <input id="cantidad" type="number" class="form-control phone-number" wire:model="cantidad" 
                            wire:change="$emit('calcular')" required>
                        </div>
                        <x-jet-input-error for="cantidad" class="mt-2" />
                    </div>
                    <!--Valor de Inventario -->
                    <div class="p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Valor (Bs)') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <input id="valor_articulo" type="number" class="form-control phone-number" wire:model="valor_articulo"
                             wire:change="$emit('calcular')"required>
                        </div>
                        <x-jet-input-error for="valor_articulo" class="mt-2" />
                    </div>

                    <!--Total -->
                    <div class="p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Total (Bs)') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <input id="total" type="text" class="form-control phone-number" value="{{ $total }}"disabled>
                        </div>
                        <x-jet-input-error for="total" class="mt-2" />
                    </div>

                     <!--Fecha Caducidad-->
                     <div  class="col-span-1 p-1">
                        <x-jet-label for="fecha" value="{{ __('Fecha Caducidad') }}" />

                        <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}"  wire:model="fecha_caducidad" required>
                    </div>
                </div>

<!--#################################################################################################-->
                <x-jet-section-border />
                <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Categoria-->
                <div class="col-span-2">
                    <x-jet-label for="grupo_idGrupo" value="{{ __('Categoria') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                        <input id="grupo" type="text" class="form-control" wire:model.defer="categoria" disabled>
                    </div>
                    <x-jet-input-error for="nombre_grupo" class="mt-2" />
                </div>

                <!--Subcategoria-->
                <div class="">
                    <x-jet-label for="cuenta_idCuenta" value="{{ __('Tipo') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-list-ol"></i>
                            </div>
                        </div>
                        <input id="grupo" type="text" class="form-control" wire:model.defer="subcategoria" disabled>
                    </div>
                    <!--<x-jet-input id="cuenta_idCuenta" type="text" class="mt-1 block w- form-control shadow-none" wire:model.defer="producto.cuenta_idCuenta" required />-->
                    <x-jet-input-error for="nombre_cuenta" class="mt-2" />
                </div>

            </div>
            <!--Receçionandte-->
            
                    <div class="p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Nombre Proveedor') }}" />
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input id="valor_articulo" type="text" class="form-control " wire:model="recep"
                            required>
                        </div>
                        <x-jet-input-error for="valor_articulo" class="mt-2" />
                    </div>
                    

			</x-slot>
			<x-slot name="footer">
                
                <x-jet-secondary-button wire:click="limpiarCampos" class="justify-center p-2"> Limpiar</x-jet-danger-button>
				<x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
				<x-jet-danger-button wire:click="closeModal" class="justify-center"> Cancelar</x-jet-danger-button>
			</x-slot>
		</x-jet-dialog-modal>


		<x-notify-message on="saved" type="success" message="Entrada creado correctamente!" />
		<x-notify-message on="edit" type="success" message="Entrada modificado correctamente!" />

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
                            <th class="cursor-pointer" wire:click="order('proveedor_idProveedor')">
								<a>Proveedor
                                @if ($sort == 'proveedor_idProveedor')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer" wire:click="order('cantidad')">
								<a>Cantidad Ingresada
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

                            <th class="cursor-pointer" wire:click="order('n_lote')">
								<a>N°Lote - Comporbante
                                @if ($sort == 'n_lote')
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
                            

                        
                        <th><a>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($entradas as $entrada)
                    <tr x-data="window.__controller.dataTableController({{ $entrada->id }})">
                        @foreach ($productos as $producto)
                            @if($entrada->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
                            @endif
                        @endforeach

                        @foreach ($productos as $producto)
                            @if($entrada->producto_idProducto == $producto->id)
                                <td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach

                        @foreach ($proveedores as $proveedor)
                            @if($entrada->proveedor_idProveedor == $proveedor->id)
                                <td>{{ $proveedor-> nombre_proveedor }}</td>
                            @endif
                        @endforeach
                        
                        <td>{{ $entrada->cantidad}}</td>
                        <td>{{ $entrada->n_lote}}</td>
                        <td>{{ $entrada->fecha_adquisicion}}</td>
                        <td>{{ $entrada->fecha_caducidad}}</td>
                        <td class="whitespace-no-wrap row-action--icon">
                            <a href="/reporte/entrada/pdf/{{ $entrada->id}}" role="button" class="mr-3"><i class="fa fa-16px fa-file-pdf"></i></a>
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
<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        flatpickr("#fecha_ingreso", {
            mode: "range",
            dateFormat: "Y-m-d"
        });
    </script>

