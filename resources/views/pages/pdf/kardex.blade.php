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
        <img src="{{$imagePath}}" width="80px" height="70px" style="margin-right: 10px;">
    </div>
    <div class="header">
		<div style="display: flex; align-items: center; padding: 30px;">
		
		<h2 style="text-align: center; color: green; margin-top: -40px">CAJA NACIONAL DE SALUD </h2>
		<p style="text-align: center; color: gray; margin-top: -10px; font-size:10px">DISTRITAL YACUIBA-TARIJA-BOLIVIA C/CREAVAUX N°243-TELEFAX 6822256-6282259</p>
	</div>
        
        <h1>"KARDEX DE ARTICULO"</h1>
    </div>    

        @php
			$saldoAcumulado = 0;
		@endphp

		@if ($kardex)
			<h4 >Nombre del Artículo:</h4> <p> {{$nombreProducto}},</p> 
			<h4 >Total Cantidad en Stock:</h4> <p>{{$cantidad}}</p>

			<div class="row">
				<div class="table-responsive">
					<table class="table table-centered mb-0 align-middle table-hover table-nowrap">
						<thead>
							<tr style="background: #D0CECE;">
								<th>Fecha</th>
								<th>Hora</th>
								<th>Proveedor</th>								
								<th>Entrada</th>
								<th>Salida</th>
								<th>cantidad</th>
								<th>Observación</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($kardex as $registro)
								<tr>
									<td>{{ $registro->fecha }}</td>
									<td>{{ $registro->hora }}</td>
									@foreach($proveedores as $proveedor)
										@if($registro->proveedor_idProveedor == $proveedor->id)
										<td>{{ $proveedor->nombre_proveedor }}</td>
										@endif
									@endforeach
									
									<td>{{ $registro->cantidad_entrada }}</td>
									<td>{{ $registro->cantidad_salida }}</td>
									<td>@php	
											$saldoAcumulado += $registro->cantidad_entrada - $registro->cantidad_salida;
											echo $saldoAcumulado;
										@endphp
									</td>
									<td>{{ $registro->obs }}</td>
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
