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

	

        <div>
    <table class="table">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre Producto</th>
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