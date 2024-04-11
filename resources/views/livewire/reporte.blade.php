<div>
	<x-slot name="header_content">
		<h1>{{ __('Reportes') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Información</a></div>
			<div class="breadcrumb-item"><a href="{{ route('reporte') }}">Reportes</a></div>
		</div>
	</x-slot>

    @role('Admin')
	<div class="p-8 pt-4 mt-2 bg-white">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h2>Seleccione la opción para generar el reporte</h2>
					</div>
					<div class="card-body">
						<div class="row mt-4">
							<div class="col-12 col-lg-8 offset-lg-2">
								<div class="wizard-steps">

									<a href="{{ route('reporte.vencimiento') }}" class="wizard-step wizard-step-success" style="text-decoration: none;">
										<div class="wizard-step-icon">
											<i class="fas fa-calendar"></i>
										</div>
										<div class="wizard-step-label">
											Artículos vencidos o próximos a vencer
										</div>
									</a><!--End cart-->

									<a href="{{ route('reporte.stock') }}" class="wizard-step wizard-step-success" style="text-decoration: none;">
										<div class="wizard-step-icon">
											<i class="fas fa-box-open"></i>
										</div>
										<div class="wizard-step-label">
											Cantidad Stock
										</div>
									</a><!--End cart-->

									<a href="{{ route('reporte.sinsalida') }}" class="wizard-step wizard-step-success" style="text-decoration: none;">
										<div class="wizard-step-icon">
											<i class="fas fa-sign-out-alt"></i>
										</div>
										<div class="wizard-step-label">
											Artículos sin salida
										</div>
									</a><!--End cart-->

									<a href="{{ route('reporte.almacen') }}" class="wizard-step wizard-step-success" style="text-decoration: none;">
										<div class="wizard-step-icon">
											<i class="fas fa-store"></i>
										</div>
										<div class="wizard-step-label">
											Artículos que no están en almacén
										</div>
									</a><!--End cart-->
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!--End Admin vista-->

	@else
	@endrole

</div>