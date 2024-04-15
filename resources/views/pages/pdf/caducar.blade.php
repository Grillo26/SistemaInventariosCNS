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
        
        <h1>"ARTÍCULOS POR VENCER"</h1>
    </div>    
	@if($articulosCaducar->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th class="cursor-pointer">
								<a>Código Producto
                            </th>
                            <th class="cursor-pointer">
								<a>Nombre Producto
                            </th>
							<th class="cursor-pointer"  >
                                <a>Vence en
                            </th>

                            <th class="cursor-pointer">
                                <a>Fecha Caducidad
                            </th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($articulosCaducar as $articulo)
                    <tr x-data="window.__controller.dataTableController({{ $articulo->id }})">
                        @foreach ($productos as $producto)
                            @if($articulo->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
								<td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach
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
							
                        <td>{{ $articulo->fecha_caducidad}}</td>
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
</body>
</html>
