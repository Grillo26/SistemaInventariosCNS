<div>
	<x-slot name="header_content">
		<h1>{{ __('Verificar Stock de Artículo') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Artículos</a></div>
			<div class="breadcrumb-item"><a href="{{ route('stock') }}">Stock</a></div>
		</div>
	</x-slot>
	<div class="p-8 pt-4 mt-2 bg-white">

		<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-3">
			<!--Codigo Identificación -->
			<div class="">
				<x-jet-label for="codigo_producto" value="{{ __('Ingrese código de Artículo para ver detalles') }}" />
        
				<div class="input-group" wire:ignore>
					<div class="input-group-prepend">
						<div class="input-group-text">
							<i class="fas fa-box"></i>
						</div>
					</div>
					<select wire:model="codigo_producto" class="form-control select2" id="producto">
                            <option value=" ">Buscar Artículo</option>
                            @foreach($entradas as $entrada)
                                @foreach($productos as $producto)

                                    @if($entrada->producto_idProducto == $producto->id)
                                        <option value="{{ $entrada->id}}"> {{$producto->codigo_producto}}</option>
                                    @endif

                                @endforeach
                            @endforeach
                    </select>
				</div>
			</div>
			<script>
				document.addEventListener('livewire:load', function(){
				                            
				    $('.producto').select2();
				    $('#producto').on('change', function(){
				        @this.set('codigo_producto', this.value); //Conecta con la variable en el controladors
				    });
			    });
			</script>

            <div class="">
                <!--Nombre--> 
                <div class="col-span-2 p-1">
                        <x-jet-label for="nombre_producto" value="{{ __('Nombre') }}" />
                        
                        <div class="input-group">
                            
                            <input id="nombre_producto" type="text" class="form-control phone-number" wire:model.defer="nombre_producto" disabled>
                        </div>
                        <x-jet-input-error for="nombre_producto" class="mt-2" />
                    </div>
        
            </div>
		</div>


		<x-jet-section-border />

		<div class="row">

			<!--Stock Disponible Cantidad-->
			<div class="col-xl-4 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-truncate font-size-14 mb-2">Cantidad Disponible</p>
								<h4 class="mb-2">{{ $cantidad }}</h4>
								<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>9.23%</span> from previous period</p>
							</div>
							<div><span class="  text-success "><i class="fas fa-box-open" style="font-size: 40px;"></i></span></div>
						</div>
					</div>
					<!-- end cardbody -->
				</div>
				<!-- end card -->
			</div>
			<!-- end col -->


			<!--Fecha Caducidad-->
			<div class="col-xl-4 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-truncate font-size-14 mb-2">Fecha de Caducidad</p>
								<h4 class="mb-2">{{ $fecha_caducidad}}</h4>
								<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>9.23%</span> from previous period</p>
							</div>
							<div><span class="  text-success "><i class="fas fa-calendar-check" style="font-size: 40px;"></i></span></div>
						</div>
					</div>
					<!-- end cardbody -->
				</div>
				<!-- end card -->
			</div>
			<!-- end col -->

			<!--Proveedor-->
			<div class="col-xl-4 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-truncate font-size-14 mb-2">Proveedor</p>
								<h4 class="mb-2">{{ $proveedor_idProveedor}}</h4>
								<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>9.23%</span> from previous period</p>
							</div>
							<div><span class="  text-success "><i class="fas fa-truck" style="font-size: 40px;"></i></span></div>
						</div>
					</div>
					<!-- end cardbody -->
				</div>
				<!-- end card -->
			</div>
			<!-- end col -->



		</div>

	</div>

</div>