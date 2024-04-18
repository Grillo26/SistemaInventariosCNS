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
        p {
            font-size: 16px;
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
        <h1>"REPORTE DE SALIDAS DEL ALMACÉN"</h1>
    </div>
    <p>Reporte de salidas de artículos del almacén entre el rango de fechas {{$fechaI}} y {{$fechaF}} en la unidad de Almacenes de
        la Caja Nacional de Salud Distrital Yacuiba.
    </p>
	<!--TABLE-->
    @if($salidas->count())
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
                            <th class="cursor-pointer">
								<a>Fecha Salida

                            </th>
                            <th class="cursor-pointer" >
                                <a>Cantidad
                            </th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($salidas as $salida)
                    <tr x-data="window.__controller.dataTableController({{ $salida->id }})">
                        @foreach ($productos as $producto)
                            @if($salida->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
								<td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach

                        <td>{{ $salida->fecha_salida}}</td>
                        <td>{{ $salida->cantidad}}</td>
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
        <p>Encargado Almacén</p>
        </div>
	
</div>
</body>
</html>
