<div>
	<x-slot name="header_content">
		<h1>{{ __('Busqueda de Artículos') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Artículos</a></div>
			<div class="breadcrumb-item"><a href="{{ route('stock') }}">Busqueda</a></div>
		</div>
	</x-slot>

	@role('Admin')
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
						<select wire:model="codigo_producto" class="form-control select2" id="producto" >
								<option value=" ">Buscar Artículo</option>
									@foreach($productos as $producto)				
										<option value="{{ $producto->id}}"> {{$producto->codigo_producto}}</option>
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
					<h1 style="padding-top: 30px; padding-left: 20px; font-size: 24px; color: #333;">{{ $nombre_producto}}</h1>

				</div>
			</div>


			<x-jet-section-border />

			<div class="row">

				<!--PASILLO-->
				<div class="col-xl-4 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="d-flex">
								<div class="flex-grow-1">
									<p class="text-truncate font-size-14 mb-2">Pasillo</p>
									<h1 style="font-size: 24px; color: #333;" class="mb-2">{{ $pasillo }}</h1>							</div>
								<div><span class="  text-success "><i class="fas fa-door-closed" style="font-size: 40px;"></i></span></div>
							</div>
						</div>
						<!-- end cardbody -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col -->


				<!--ESTANTE-->
				<div class="col-xl-4 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="d-flex">
								<div class="flex-grow-1">
									<p class="text-truncate font-size-14 mb-2">Estante</p>
									<h1 style="font-size: 24px; color: #333;" class="mb-2">{{ $estante}}</h1>
									<span class="text-danger text-danger fw-bold font-size-12 me-2">

								</div>
								<div><span class="  text-success "><i class="fas fa-building" style="font-size: 40px;"></i></span></div>
							</div>
						</div>
						<!-- end cardbody -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col -->

				<!--MESA-->
				<div class="col-xl-4 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="d-flex">
								<div class="flex-grow-1">
									<p class="text-truncate font-size-14 mb-2">Mesa</p>
									<h1 style="font-size: 24px; color: #333;" class="mb-2">{{ $mesa}}</h1>
								</div>
								<div><span class="  text-success "><i class="fas fa-chair" style="font-size: 40px;"></i></span></div>
							</div>
						</div>
						<!-- end cardbody -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col -->



			</div>

		</div>
	@else
	<livewire:unauthorized-message />
	@endrole
</div>