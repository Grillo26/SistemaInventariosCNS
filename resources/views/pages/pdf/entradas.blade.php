<!--TABLE-->
@if($entradas->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th>Código Producto</th>
                            <th>Nombre Producto</th>
                            <th>Fecha de Ingreso</th>
                            <th >Cantidad</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($entradas as $entrada)
                    <tr x-data="window.__controller.dataTableController({{ $entrada->id }})">
                        @foreach ($productos as $producto)
                            @if($entrada->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
								<td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach

                        <td>{{ $entrada->fecha_adquisicion}}</td>
                        <td>{{ $entrada->cantidad}}</td>
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
