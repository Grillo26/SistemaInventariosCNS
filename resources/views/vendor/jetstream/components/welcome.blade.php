@php
$user = auth()->user();
$usersCount = \App\Models\User::count();
$proveedores = \App\Models\Proveedor::count();
$solicitantes = \App\Models\Solicitante::count();

//solicitudes atendidas y no atendidas
$solicitudesNoAtendidas = App\Models\Solicitante::where('estado_idEstado', 1)->count(); 

$articulos = \App\Models\Entrada::count();
$totalArticulos = App\Models\Inventario::selectRaw('SUM(cantidad_entrada) - SUM(cantidad_salida) as total')
        ->groupBy('producto_id')
        ->pluck('total')
        ->sum();
	
$productos = App\Models\Producto::all();

	// Fecha actual
	$fechaActual = now();

	// Obtener la fecha actual más 10 días
	$fechaLimite = $fechaActual->addDays(10);

	// Contar cuántos artículos tienen fecha de caducidad dentro de los próximos 10 días
	$articulosCaducanEn10Dias = App\Models\Entrada::whereDate('fecha_caducidad', '<=', $fechaLimite)->count();

	// Verificar si hay algún artículo vencido
	$articulosVencidos = App\Models\Entrada::whereDate('fecha_caducidad', '<=', $fechaActual)->count();

	// Si hay artículos vencidos, almacenar el conteo en la variable $articulos_vencidos
	if ($articulosVencidos > 0) {
		$articulos_vencidos = $articulosVencidos;
	} else {
		// Si no hay artículos vencidos, mantener la variable $articulos_vencidos como estaba
		$articulos_vencidos = $articulosCaducanEn10Dias;
	}

	$articulosProximoCaducar = App\Models\Entrada::whereDate('fecha_caducidad', '<=', $fechaLimite)->get();


@endphp
<!--<div class="col-12 p-2">
    <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('{{ asset('img/almacen.png') }}');">
        <div class="hero-inner">
            <h2>Bienvenido, {{ $user->name }}</h2>
            <p class="lead">Este sistema esta creado a medida para la Caja Nacional de Salud distrital Yacuiba. Cualquier consulta o duda recurra 
                al manual del usuario o contáctese con el desarrollador.
            </p>

        </div>
    </div>
</div>-->


<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<p class="text-truncate font-size-14 mb-2">Total Artículos en Almacén</p>
						<h4 class="mb-2">{{ $totalArticulos}}</h4>
						@if($articulos_vencidos > 0)
							<p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>{{ $articulos_vencidos}}</span> Lotes vencidos o por vencer</p>
						@else
							<p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>{{ $articulosCaducanEn10Dias}}</span> Artículos están por caducar</p>
						@endif
					</div>
						<div><span class="  text-success "><i class="fas fa-cart-plus" style="font-size: 40px;"></i></span></div>
				</div>

			</div>
			<!-- end cardbody -->
		</div>
		<!-- end card -->
	</div>
	<!-- end col -->
	
	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<p class="text-truncate font-size-14 mb-2">Total Usuarios</p>
						<h4 class="mb-2">{{ $usersCount }}</h4>
						<p class="text-muted mb-0"> Registrados en el sistema</p>
					</div>
						<div><span class="  text-success "><i class="fas fa-user" style="font-size: 40px;"></i></span></div>
				</div>
			</div>
			<!-- end cardbody -->
		</div>
		<!-- end card -->
	</div>
	<!-- end col -->

	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<p class="text-truncate font-size-14 mb-2">Solicitudes Nuevas</p>
						<h4 class="mb-2">{{ $solicitantes}}</h4>
						<p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>{{ $solicitudesNoAtendidas}}</span> Solicitudes No Atendidas</p>
					</div>
						<div><span class="  text-success "><i class="fas fa-paperclip" style="font-size: 40px;"></i></span></div>
				</div>
			</div>
			<!-- end cardbody -->
		</div>
		<!-- end card -->
	</div>
	<!-- end col -->

	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<p class="text-truncate font-size-14 mb-2">Total de Proveedores</p>
						<h4 class="mb-2">{{ $proveedores}}</h4>
						<p class="text-muted mb-0"> Proveedores de artículos requeridos</p>
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


<div class="row">
	<!--TABLA-->
	<div class="col-xl-8">
		<div class="card">
			<div class="card-body">
			
				<h4 class="card-title mb-4">Artículos Próximos a Caducar</h4>

				<div class="table-responsive">
					<table class="table table-centered mb-0 align-middle table-hover table-nowrap">
						<thead class="table-light">
							<tr>
								<th>Código Artículo</th>
								<th>Nombre Artículo</th>
								<th>Fecha Caducidad</th>
								<th>Vence en</th>
								<th>N° de Lote</th>
								
							</tr>
						</thead>
						<!-- end thead -->
						<tbody>
							@foreach($articulosProximoCaducar as $articulo)
							<tr>
								@foreach ($productos as $producto)
									@if($articulo->producto_idProducto == $producto->id)
										<td><h6 class="mb-0">{{ $producto -> codigo_producto }}</h6></td>
									@endif
								@endforeach
									
								@foreach ($productos as $producto)
									@if($articulo->producto_idProducto == $producto->id)
										<td>{{ $producto -> nombre_producto }}</td>
									@endif
								@endforeach				

								<td>{{ $articulo -> fecha_caducidad}}</td>
								<td>
									@php
										$fechaCaducidad = \Carbon\Carbon::parse($articulo->fecha_caducidad);
										$hoy = \Carbon\Carbon::now();
										$diasRestantes = $hoy->diffInDays($fechaCaducidad, false); // false para contar solo días futuros
									@endphp

									@if ($diasRestantes < 0)
										<span class="text-danger">Artículo vencido</span>
									@else
										{{ $diasRestantes }} días
									@endif
								</td>

								<td>{{ $articulo -> n_lote}}</td>
					
							</tr>
							@endforeach
						</tbody>
						<!-- end tbody -->
					</table>
					<!-- end table -->
				</div>
			</div>
			<!-- end card -->
		</div>
		<!-- end card -->
	</div>
	<!-- end col -->

	<div class="col-xl-4 bg-white">
		<div class="card-body">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active show" id="nosotros-tab" data-toggle="tab" href="#nosotros" role="tab" aria-controls="nosotros" aria-selected="true">Nosotros</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="mision-tab" data-toggle="tab" href="#mision" role="tab" aria-controls="mision" aria-selected="false">Misión</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="vision-tab" data-toggle="tab" href="#vision" role="tab" aria-controls="vision" aria-selected="false">Visión</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade active show" id="nosotros" role="tabpanel" aria-labelledby="nosotros-tab">
			La Caja Nacional de Salud es una institución descentralizada de derecho público sin fines de lucro, con personeria jurídica, autonomía de gestión y patrimonio independiente, encargada de la gestión, aplicación y ejecución del régimen de Seguridad Social a corto plazo (enfermedad, maternidad y riesgos profesionales).
			<div class="col-12 col-sm-6 col-md-6 col-lg-12">
                <article class="article">
                  <div class="article-header">
                    <div class="article-image" data-background="url('{{ asset('img/personal.jpg') }}" style="background-image: url('{{ asset('img/personal.jpg') }}');">
                    </div>
                    <div class="article-title">
                      <h2><a href="#">Caja Nacional de Salud Distrital Yacuiba</a></h2>
                    </div>
                  </div>
                  <div class="article-details">
                    Este sistema fue desarrollado a medida y con los requerimentos proporcionados por el personal del almacén de la Caja Nacional de Salud Distrital Yacuiba.</p> <br>
                    <div class="article-cta">
                      
					<x-jet-button>
					  <a href="https://www.cns.gob.bo/contactos/contactos" ><i class="text-white">Página Web</i></a>
           			</x-jet-button>
                    </div>
                  </div>
                </article>
              </div>
			</div>
			<div class="tab-pane fade" id="mision" role="tabpanel" aria-labelledby="mision-tab">
			La Caja Nacional de Salud suministrará a sus asegurados las prestaciones en servicios, especie y dinero del régimen de enfermedad, maternidad y riesgos profesionales a corto plazo establecidas por el Código de Seguridad Social, su Reglamento y disposiciones conexas.
			</div>
			<div class="tab-pane fade" id="vision" role="tabpanel" aria-labelledby="vision-tab">
			La Caja Nacional de Salud es referente nacional e internacional en la prestación de servicios integrales de salud de la seguridad social de corto plazo, con calidad, transparencia, compromiso, integralidad, excelencia y sostenibilidad
			</div>
		</div>
	</div>
</div>

