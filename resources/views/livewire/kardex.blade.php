@role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
			
				<a href="reporte/kardex/pdf/{{ $productoId }}" class="ml-2 btn btn-success shadow-none">
					Exportar PDF
					<span class="fas fa-file-export"></span> 
				</a>

				<a href="reporte/kardex/word/{{ $productoId }}" class="ml-2 btn btn-primary shadow-none">
					Exportar WORD
					<span class="fas fa-file-word"></span> 
				</a>
                <!--<div class="col">
                    <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
                </div>-->
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

		@php
			$saldoAcumulado = 0;
		@endphp

		@if ($kardex)
			<h4 >Nombre del Artículo:</h4> <p> {{$nombre_producto}},</p> 
			<h4 >Total Cantidad en Stock:</h4> <p>{{$cantidad}}</p>

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
									@foreach($proveedores as $proveedor)
										@if($registro->proveedor_idProveedor == $proveedor->id)
										<td>{{ $proveedor->nombre_proveedor }}</td>
										@endif
									@endforeach
									
									<td>{{ $registro->cantidad_entrada }}</td>
									<td>{{ $registro->cantidad_salida }}</td>
									<td>@php	
											$saldoAcumulado += $registro->cantidad_entrada - $registro->cantidad_salida;
											echo $saldoAcumulado;
										@endphp
									</td>
									<td>{{ $registro->obs }}</td>
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