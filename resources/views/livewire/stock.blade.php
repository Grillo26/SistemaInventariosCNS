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

			<!--Stock Disponible Cantidad-->
			<div class="col-xl-6 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-truncate font-size-14 mb-2">Cantidad Disponible</p>
								<h1 style="font-size: 24px; color: #333;" class="mb-2">{{ $cantidad }}</h1>
								<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i></span>Unidades</p>
							</div>
							<div><span class="  text-success "><i class="fas fa-box-open" style="font-size: 40px;"></i></span></div>
						</div>
					</div>
					<!-- end cardbody -->
				</div>
				<!-- end card -->
			</div>
			<!-- end col -->


			<!--Fecha Caducidad
			<div class="col-xl-6 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-truncate font-size-14 mb-2">Fecha de Caducidad</p>
								<h1 style="font-size: 24px; color: #333;" class="mb-2">{{ $fecha_caducidad}}</h1>
								
								@if($vencida == true)
								<p class="text-muted mb-0">El artículo lleva: 
                                <span class="text-danger text-danger fw-bold font-size-12 me-2">
                                <i class="ion-ios-cart"></i>{{$dias_vencidos}}</span> días vencidos</p>
								@else
								<p class="text-muted mb-0">Quedan: 
                                <span class="text-danger text-danger fw-bold font-size-12 me-2">
								<i class="ion-ios-cart"></i>{{$dias_restantes}}</span> días para que el artículo se venza</p>
								@endif

							</div>
							<div><span class="  text-success "><i class="fas fa-calendar-check" style="font-size: 40px;"></i></span></div>
						</div>
					</div>
			
				</div>
			
			</div>-->

		</div>

	</div>

</div>