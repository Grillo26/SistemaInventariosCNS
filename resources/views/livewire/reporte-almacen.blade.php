<div>
    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
			
				<a href="{{ route('almacen.pdf')}}" class="ml-2 btn btn-success shadow-none">
					Exportar PDF
					<span class="fas fa-file-export"></span> 
				</a>
				
				<a href="{{route('almacen.word')}}" class="ml-2 btn btn-primary shadow-none">
					Exportar WORD
					<span class="fas fa-file-word"></span> 
				</a>
                <!--<div class="col">
                    <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
                </div>-->
			</div> 
		</div>

	    <!--TABLE-->
        <div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
                        <th>Código del Artículo</th>
                        <th>Nombre del Artículo</th>
                        <th>Stock</th>
                        <!-- Agrega otras columnas según sea necesario -->
                    </tr>
                </thead>
        
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto['id'] }}</td>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['stock'] }}</td>
                            <!-- Agrega otras columnas según sea necesario -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    <!--End Admin vista-->
	@else
	@endrole

</div>