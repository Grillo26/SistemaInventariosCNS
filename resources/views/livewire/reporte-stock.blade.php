<div>
    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
                @if($search == "")
                    <a href="{{ route('all.pdf')}}" class="ml-2 btn btn-success shadow-none">
					Exportar Todo PDF
					<span class="fas fa-file-export"></span> 
				    </a>

                    <a href="#" class="ml-2 btn btn-danger shadow-none">
					Exportar EXCEL
					<span class="fas fa-file-excel"></span> 
				    </a>

                    <a href="{{ route('all.word')}}" class="ml-2 btn btn-primary shadow-none">
					Exportar Todo WORD
					<span class="fas fa-file-word"></span> 
				    </a>
                @else
                    <a href="/reporte/stock/pdf/{{$search}}" class="ml-2 btn btn-success shadow-none">
					Exportar PDF
					<span class="fas fa-file-export"></span> 
				    </a>

                    <a href="#" class="ml-2 btn btn-danger shadow-none">
					Exportar EXCEL
					<span class="fas fa-file-excel"></span> 
				    </a>

                    <a href="/reporte/stock/word/{{$search}}" class="ml-2 btn btn-primary shadow-none">
					Exportar WORD
					<span class="fas fa-file-word"></span> 
				    </a>
                @endif

		


                <!--<div class="col">
                    <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
                </div>-->
			</div> 

			<div class="col pt-2">
				<input wire:model="search" class="form-control" type="text" placeholder="Buscar por código o nombre de producto...">
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
                            <th class="cursor-pointer" wire:click="order('producto_id')">
								<a>Categoría
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
								<a>SubCategoría
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
                        
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($stock as $item)
                        <tr>
                            @foreach($productos as $producto)
                                @if($item->producto_id == $producto->id)
                                    <td>{{ $producto->codigo_producto }}</td>
                                    <td>{{ $producto->nombre_producto }}</td>

                                    @foreach($categorias as $categoria)
                                        @if($producto->categoria_idCategoria == $categoria->id)
                                        <td>{{ $categoria->nombre_categoria }}</td>
                                        @endif
                                    @endforeach

                                    @foreach($subcategorias as $subcategoria)
                                        @if($producto->subcategoria_idSubcategoria == $subcategoria->id)
                                        <td>{{ $subcategoria->nombre_subcategoria }}</td>
                                        @endif
                                    @endforeach

                                @endif
                            @endforeach

                            @foreach($proveedores as $proveedor)
                                @if($item->proveedor_idProveedor == $proveedor->id)
                                    <td>{{ $proveedor->nombre_proveedor }}</td>
                                @endif
                            @endforeach
                            <td>{{ $item->cantidad }}</td>
                            <td class="whitespace-no-wrap row-action--icon">
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