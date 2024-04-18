<div>
    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
			
				<a href="solicitudes/pdf/{{ $estadoSeleccionado}}" class="ml-2 btn btn-success shadow-none">
					Exportar PDF
					<span class="fas fa-file-export"></span> 
				</a>


				<a href="solicitudes/word/{{ $estadoSeleccionado}}" class="ml-2 btn btn-primary shadow-none">
					Exportar WORD
					<span class="fas fa-file-word"></span> 
				</a>
                <!--<div class="col">
                    <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
                </div>-->
			</div> 
		</div>

		<!-- Selector de estado -->
		<div class="row mb-4">
			<div class="input-group" wire:ignore>
				<div class="input-group-prepend">
						<div class="input-group-text">
							<i class="fas fa-box-open"></i>
						</div>
						<select wire:model="estadoSeleccionado" class="form-control">
							<option value="3">Todos</option>
							<option value="1">No respondido</option>
							<option value="2">Respondido</option>
						</select>
				</div>
			</div>
		</div>

	    <!--TABLE-->
        <div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th><a>
							Id Solicitud
							</a></th>

							<th><a>
								Referencia	
							</a></th>

							<th><a>
								Detalle
							</a></th>

							<th><a>
								Cantidad
							</a></th>

							<th><a>
								Código Artículo
							</a></th>

							<th><a>
								Nombre Artículo
							</a></th>
							<th><a>Solicitante</a></th>

							<th><a>Estado</a></th>
						</tr>
					</thead>
					
					<tbody>
						<!--Si es Administrador-->

							@foreach ($solicitantes as $solicitante)
								<tr>
									<td>{{ $solicitante->id }}</td>
									<td>{{ $solicitante->referencia }}</td>
									<td>{{ $solicitante->detalle }}</td>
									<td>{{ $solicitante->cantidad }}</td>
									@foreach ($productos as $producto)
										@if($solicitante->producto_idProducto == $producto->id)
											<td>{{ $producto->codigo_producto }}</td>
											<td>{{ $producto->nombre_producto }}</td>
										@endif
									@endforeach

									@foreach ($users as $user)
										@if($solicitante->user_id == $user->id)
											<td>{{ $user->name . ' ' . $user->lastname }}</td> <!--Concatena el nombre y el apellido-->
										@endif
									@endforeach

									@foreach ($estados as $estado)
										@if($solicitante->estado_idEstado == $estado->id)
											<td>{{ $estado->estado }}</td>
										@endif
									@endforeach
								</tr>
							@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
    <!--End Admin vista-->
	@else
	@endrole

</div>