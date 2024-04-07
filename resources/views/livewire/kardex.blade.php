@role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
				<a href="#" class="ml-2 btn btn-success shadow-none">
					Exportar
					<span class="fas fa-file-export"></span> 
				</a>
				<a href="#" class="ml-2 btn btn-danger shadow-none">
					Exportar
					<span class="fas fa-file-excel"></span> 
				</a>
			</div>

			<div class="col form-inline">
				
				
			</div>

			<div class="col">
			</div>
		</div>

		<div class="row mb-4">

			<div class="input-group" wire:ignore>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <select wire:model="productoId" class="form-control select2" id="producto">
                        <option value=" "> </option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->codigo_producto}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
			<script>
                document.addEventListener('livewire:load', function(){
                            
                    $('.producto').select2();
                    $('#producto').on('change', function(){
                        @this.set('productoId', this.value); //Conecta con la variable en el controladors
                    });
                });
            </script>
		</div>

		

		@if ($kardex)
			<h4 class="card-title mb-4">Nombre del Artículo: {{$nombre_producto}}</h4>

			<div class="row">
				<div class="table-responsive">
					<table class="table table-centered mb-0 align-middle table-hover table-nowrap">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Hora</th>
								<th>Proveedor</th>								
								<th>Entrada</th>
								<th>Salida</th>
								<th>cantidad</th>
								<th>Observación</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($kardex as $registro)
								<tr>
									<td>{{ $registro->fecha }}</td>
									<td>{{ $registro->hora }}</td>
									<td>{{ $registro->created_at }}</td>
									<td>{{ $registro->cantidad_entrada }}</td>
									<td>{{ $registro->cantidad_salida }}</td>
									<td>{{ $registro->cantidad }}</td>
									<td>{{ $registro->cantidad }}</td>
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