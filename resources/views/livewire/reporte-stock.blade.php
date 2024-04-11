<div>
    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
				<!--<a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
					Registrar Salida
					<span class="fas fa-plus"></span> 
				</a>-->
				<a href="#" class="ml-2 btn btn-success shadow-none">
					Exportar
					<span class="fas fa-file-export"></span> 
				</a>
			</div>

			<div class="col form-inline">
				
			</div>

			<div class="col">
				<input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
			</div>
		</div>

		<!--TABLE-->
		@if($stock->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th class="cursor-pointer" wire:click="order('producto_id')">
								<a>Código Producto
                                @if ($sort == 'producto_id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif 
                            </th>
                            <th class="cursor-pointer" wire:click="order('producto_id')">
								<a>Nombre Producto
                                @if ($sort == 'producto_id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                            </th>

                            <th class="cursor-pointer" wire:click="order('proveedor_idProveedor')" >
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

                            <th class="cursor-pointer" wire:click="order('cantidad')" >
                                <a>Stock Disponible
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
                    @foreach($stock as $item)
                        <tr>
                            @foreach($productos as $producto)
                                @if($item->producto_id == $producto->id)
                                    <td>{{ $producto->codigo_producto }}</td>
                                    <td>{{ $producto->nombre_producto }}</td>
                                @endif
                            @endforeach

                            @foreach($proveedores as $proveedor)
                                @if($item->proveedor_idProveedor == $proveedor->id)
                                    <td>{{ $proveedor->nombre_proveedor }}</td>
                                @endif
                            @endforeach
                            <td>{{ $item->cantidad }}</td>
                            <td class="whitespace-no-wrap row-action--icon">
                            <a wire:click="editar({{$item->id}})" role="button" class="mr-3"><i class="fa fa-50px fa-print"></i></a></td>
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
	<!--End Admin vista-->

	@else
	@endrole

</div>