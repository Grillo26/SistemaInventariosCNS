<div>
    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">

		<!--Options-->
		<div class="row mb-4">

			<!--Butons-->
			<div class="flex pb-4 pt-2 pl-2 -ml-3">
			
				<a href="{{ route('proveedores.pdf')}}" class="ml-2 btn btn-success shadow-none">
					Exportar PDF
					<span class="fas fa-file-export"></span> 
				</a>
				<a href="#" class="ml-2 btn btn-danger shadow-none">
					Exportar EXCEL
					<span class="fas fa-file-excel"></span> 
				</a>

				<a href="{{ route('proveedores.word')}}" class="ml-2 btn btn-primary shadow-none">
					Exportar WORD
					<span class="fas fa-file-word"></span> 
				</a>
                <!--<div class="col">
                    <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
                </div>-->
			</div> 

		</div>

		<!--TABLE-->
		@if($proveedores->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
                        <tr>
                            <th class="cursor-pointer" wire:click="order('id')">
                                    <a>Id Proveedor
                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="text-muted fas fa-sort"></i>
                                    @endif 
                                </th>
                                <th class="cursor-pointer" wire:click="order('nombre_proveedor')">
                                    <a>Nombre Proveedor
                                    @if ($sort == 'nombre_proveedor')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="text-muted fas fa-sort"></i>
                                    @endif
                                </th>

                                <th class="cursor-pointer" wire:click="order('email')">
                                    <a>Correo Proveedor
                                    @if ($sort == 'email')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="text-muted fas fa-sort"></i>
                                    @endif
                                </th>
                            
                            <th>Acciones</th>
                         </tr>
                    </thead>

                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr x-data="window.__controller.dataTableController({{ $proveedor->id }})">
                                <td>{{ $proveedor->id }}</td>
                                <td>{{ $proveedor->nombre_proveedor }}</td>
                                <td>{{ $proveedor->email }}</td>
                                <td class="whitespace-no-wrap row-action--icon">
                                    <a role="button" href="/proveedor/edit/{{$proveedor->id }}" class="mr-3"><i class="fa fa-16px fa-print"></i></a>
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

	<!--End Admin vista-->

	@else
	@endrole

</div>