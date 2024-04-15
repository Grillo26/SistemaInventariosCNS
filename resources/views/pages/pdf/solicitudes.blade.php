<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Registros</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .logo1 {
            width: 50px;
            float: right;
        }
        .logo2{
            float: left;
            width: 50px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        
        <h1>"REPORTE DE SOLICITUD"</h1>
    </div>

    <!--TABLE-->
    <div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th><a>
							Id Solicitud
							</a></th>

							<th><a>
								Referencia	
							</a></th>

							<th><a>
								Detalle
							</a></th>

							<th><a>
								Cantidad
							</a></th>

							<th><a>
								Código Artículo
							</a></th>

							<th><a>
								Nombre Artículo
							</a></th>
							<th><a>Solicitante</a></th>

							<th><a>Estado</a></th>
						</tr>
					</thead>
					
					<tbody>
						<!--Si es Administrador-->

							@foreach ($solicitantes as $solicitante)
								<tr>
									<td>{{ $solicitante->id }}</td>
									<td>{{ $solicitante->referencia }}</td>
									<td>{{ $solicitante->detalle }}</td>
									<td>{{ $solicitante->cantidad }}</td>
									@foreach ($productos as $producto)
										@if($solicitante->producto_idProducto == $producto->id)
											<td>{{ $producto->codigo_producto }}</td>
											<td>{{ $producto->nombre_producto }}</td>
										@endif
									@endforeach

									@foreach ($users as $user)
										@if($solicitante->user_id == $user->id)
											<td>{{ $user->name . ' ' . $user->lastname }}</td> <!--Concatena el nombre y el apellido-->
										@endif
									@endforeach

									@foreach ($estados as $estado)
										@if($solicitante->estado_idEstado == $estado->id)
											<td>{{ $estado->estado }}</td>
										@endif
									@endforeach
								</tr>
							@endforeach
					</tbody>
				</table>
			</div>
		</div>
</div>
</body>
</html>
