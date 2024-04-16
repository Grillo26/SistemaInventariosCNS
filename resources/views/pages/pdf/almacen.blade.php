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
		<div class="row">
			<div class="table-responsive">
                <table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
						<tr>
                        <th>Código del Artículo</th>
                        <th>Nombre del Artículo</th>
                        <th>Stock</th>
                        <!-- Agrega otras columnas según sea necesario -->
                    </tr>
                </thead>

                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto['id'] }}</td>
                                <td>{{ $producto['nombre'] }}</td>
                                <td>{{ $producto['stock'] }}</td>
                                <!-- Agrega otras columnas según sea necesario -->
                            </tr>
                        @endforeach
                    </tbody>
				</table>
			</div>
		</div>
</div>
</body>
</html>
