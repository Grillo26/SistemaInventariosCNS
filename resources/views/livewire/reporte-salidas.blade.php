<div>
    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
			
				<a href="{{ route('salidas.pdf', ['fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin])}}"  class="ml-2 btn btn-success shadow-none">
					Exportar PDF
					<span class="fas fa-file-export"></span> 
				</a>


				<a href="{{ route('salidas.word', ['fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin])}}" class="ml-2 btn btn-primary shadow-none">
					Exportar WORD
					<span class="fas fa-file-word"></span> 
				</a>
                <!--<div class="col">
                    <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
                </div>-->
			</div> 
		</div>



        <div class="">
            <input wire:model="fechaRango" type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-border"
                    placeholder="Seleccione un rango de fechas" autocomplete="off">
        </div>
        <hr>
        <br>
        <br>
        <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
        <script src="{{ asset('js/flatpickr.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script>
            flatpickr("#fecha_ingreso", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                // Actualiza las fechas y filtra las salidas
                @this.set('fechaInicio', selectedDates[0].toISOString().split('T')[0]);
                @this.set('fechaFin', selectedDates[1].toISOString().split('T')[0]);
                @this.call('filtrarSalidas');}
            });
        </script>

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

                            <th class="cursor-pointer" wire:click="order('fecha_salida')">
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
                                <a>Cantidad
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
                    @foreach ($salidas as $salida)
                    <tr x-data="window.__controller.dataTableController({{ $salida->id }})">
                        @foreach ($productos as $producto)
                            @if($salida->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
								<td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach

                        <td>{{ $salida->fecha_salida}}</td>
                        <td>{{ $salida->cantidad}}</td>
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

	<!--End Admin vista-->

	@else
	@endrole

</div>