@php
$user = auth()->user();
@endphp
<div class="col-12 p-2">
    <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('{{ asset('img/almacen.png') }}');">
        <div class="hero-inner">
            <h2>Bienvenido, {{ $user->name }}</h2>
            <p class="lead">Este sistema esta creado a medida para la Caja Nacional de Salud distrital Yacuiba. Cualquier consulta o duda recurra 
                al manual del usuario o contáctese con el desarrollador.
            </p>

        </div>
    </div>
</div>


<div class="p-3 sm:px-20 bg-white border-b border-gray-200">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-primary">
					<i class="far fa-user"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Admin</h4>
					</div>
					<div class="card-body">
						10
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-danger">
					<i class="far fa-newspaper"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>News</h4>
					</div>
					<div class="card-body">
						42
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-warning">
					<i class="far fa-file"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Reports</h4>
					</div>
					<div class="card-body">
						1,201
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-success">
					<i class="fas fa-circle"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Online Users</h4>
					</div>
					<div class="card-body">
						47
					</div>
				</div>
			</div>
		</div>
	</div>

</div>



