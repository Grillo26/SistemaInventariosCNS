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
        /* Estilos del apartado de firma */
        .firma {
            margin-top: 100px;
            text-align: center;
        }
        .firma p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div style="display: flex; align-items: center">
        <img src="{{$imagePath}}" width="750px" height="160px" style="margin-right: 10px;">
    </div>
    <div class="header">
        
        <h1>"REPORTE DE PRODUCTOS CADUCADOS O PRÓXIMOS A CADUCAR"</h1>
    </div>
    <p>Mediante la presente, y en virtud de mis funciones, hago llegar el siguiente reporte de artículos que están próximos a caducar 
        deacuerdo con la fecha establecida y que por consiguiente ruego a quien corresponda tomar medidas oportunas con respecto
        al informe detallado en la siguiente tabla:
    <div class="header">
        
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
                                <a>Proveedor
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
                        @foreach ($proveedores as $proveedor)
                            @if($articulo->proveedor_idProveedor == $proveedor->id)
                                <td>{{ $proveedor-> nombre_proveedor}}</td>
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

        <div class="firma">
        <p>{{ $user->name . ' ' . $user->lastname }}</p>
        <p>Encargado de Almacén</p>
    </div>
</div>
</body>
</html>
