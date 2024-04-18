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
    <div style="display: flex; align-items: center">
        <img src="{{$imagePath}}" width="750px" height="160px" style="margin-right: 10px;">
    </div>
    <div class="header">
        
        <h1>"REPORTE DE ENTRADAS AL ALMACÉN"</h1>
    </div>
    <p>Reporte de Entradas de artículos del almacén entre el rango de fechas {{$fechaI}} y {{$fechaF}} en la unidad de Almacenes de
        la Caja Nacional de Salud Distrital Yacuiba.
    </p>
	<!--TABLE-->
	@if($entradas->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
							<th class="cursor-pointer" wire:click="order('producto_idProducto')">
								<a>Código Producto
                            </th>
                            <th class="cursor-pointer" wire:click="order('producto_idProducto')">
								<a>Nombre Producto
                            </th>

                            <th class="cursor-pointer" wire:click="order('fecha_salida')">
								<a>Fecha de Ingreso
                            </th>

                            <th class="cursor-pointer" wire:click="order('cantidad')" >
                                <a>Cantidad
                            </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($entradas as $entrada)
                    <tr>
                        @foreach ($productos as $producto)
                            @if($entrada->producto_idProducto == $producto->id)
                                <td>{{ $producto-> codigo_producto }}</td>
								<td>{{ $producto-> nombre_producto }}</td>
                            @endif
                        @endforeach

                        <td>{{ $entrada->fecha_adquisicion}}</td>
                        <td>{{ $entrada->cantidad}}</td>
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
