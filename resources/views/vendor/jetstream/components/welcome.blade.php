@php
$user = auth()->user();
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
						<p class="text-truncate font-size-14 mb-2">Total Sales</p>
						<h4 class="mb-2">1452</h4>
						<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>9.23%</span> from previous period</p>
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
						<p class="text-truncate font-size-14 mb-2">Total Sales</p>
						<h4 class="mb-2">1452</h4>
						<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>9.23%</span> from previous period</p>
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
						<p class="text-truncate font-size-14 mb-2">Total Sales</p>
						<h4 class="mb-2">1452</h4>
						<p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ion-ios-cart"></i>9.23%</span> from previous period</p>
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
						<p class="text-truncate font-size-14 mb-2">Total Sales</p>
						<h4 class="mb-2">1452</h4>
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

<div class="row">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-body">
			
				<h4 class="card-title mb-4">Latest Transactions</h4>

				<div class="table-responsive">
					<table class="table table-centered mb-0 align-middle table-hover table-nowrap">
						<thead class="table-light">
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Status</th>
								<th>Age</th>
								<th>Start date</th>
								<th style="width: 120px;">Salary</th>
							</tr>
						</thead>
						<!-- end thead -->
						<tbody>
							<tr>
								<td>
									<h6 class="mb-0">Charles Casey</h6></td>
								<td>Web Developer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</div>
								</td>
								<td>
									23
								</td>
								<td>
									04 Apr, 2021
								</td>
								<td>$42,450</td>
							</tr>
							<!-- end -->
							<tr>
								<td>
									<h6 class="mb-0">Alex Adams</h6></td>
								<td>Python Developer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Deactive</div>
								</td>
								<td>
									28
								</td>
								<td>
									01 Aug, 2021
								</td>
								<td>$25,060</td>
							</tr>
							<!-- end -->
							<tr>
								<td>
									<h6 class="mb-0">Prezy Kelsey</h6></td>
								<td>Senior Javascript Developer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</div>
								</td>
								<td>
									35
								</td>
								<td>
									15 Jun, 2021
								</td>
								<td>$59,350</td>
							</tr>
							<!-- end -->
							<tr>
								<td>
									<h6 class="mb-0">Ruhi Fancher</h6></td>
								<td>React Developer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</div>
								</td>
								<td>
									25
								</td>
								<td>
									01 March, 2021
								</td>
								<td>$23,700</td>
							</tr>
							<!-- end -->
							<tr>
								<td>
									<h6 class="mb-0">Juliet Pineda</h6></td>
								<td>Senior Web Designer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</div>
								</td>
								<td>
									38
								</td>
								<td>
									01 Jan, 2021
								</td>
								<td>$69,185</td>
							</tr>
							<!-- end -->
							<tr>
								<td>
									<h6 class="mb-0">Den Simpson</h6></td>
								<td>Web Designer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Deactive</div>
								</td>
								<td>
									21
								</td>
								<td>
									01 Sep, 2021
								</td>
								<td>$37,845</td>
							</tr>
							<!-- end -->
							<tr>
								<td>
									<h6 class="mb-0">Mahek Torres</h6></td>
								<td>Senior Laravel Developer</td>
								<td>
									<div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</div>
								</td>
								<td>
									32
								</td>
								<td>
									20 May, 2021
								</td>
								<td>$55,100</td>
							</tr>
							<!-- end -->
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
</div>
<!-- end row -->
</div>