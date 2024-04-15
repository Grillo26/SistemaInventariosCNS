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
        
        <h1>"STOCK EN ALMACEN"</h1>
    </div>    
	@if($stock->count())
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
								<a>Categoría                             
                            </th>
                            <th class="cursor-pointer">
								<a>Subcategoría                              
                            </th>
                            <th class="cursor-pointer">
                                <a>Proveedor                              
                            </th>
                            <th class="cursor-pointer">
                                <a>Stock Disponible                              
                            </th>
                        
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($stock as $item)
                        <tr>
                            @foreach($productos as $producto)
                                @if($item->producto_id == $producto->id)
                                    <td>{{ $producto->codigo_producto }}</td>
                                    <td>{{ $producto->nombre_producto }}</td>

                                    @foreach($categorias as $categoria)
                                        @if($producto->categoria_idCategoria == $categoria->id)
                                        <td>{{ $categoria->nombre_categoria }}</td>
                                        @endif
                                    @endforeach

                                    @foreach($subcategorias as $subcategoria)
                                        @if($producto->subcategoria_idSubcategoria == $subcategoria->id)
                                        <td>{{ $subcategoria->nombre_subcategoria }}</td>
                                        @endif
                                    @endforeach
                                @endif

  
                            @endforeach

                            @foreach($proveedores as $proveedor)
                                @if($item->proveedor_idProveedor == $proveedor->id)
                                    <td>{{ $proveedor->nombre_proveedor }}</td>
                                @endif
                            @endforeach
                            <td>{{ $item->cantidad }}</td>
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
