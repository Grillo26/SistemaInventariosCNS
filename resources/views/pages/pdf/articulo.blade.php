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
        
        <h1>"REPORTE DE ARTICULOS"

        </h1>
    </div>    

    <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-sm text-gray-600">
                    <thead>
                        <tr>
                            <td>CODIGO PRODUCTO</td>
                            <td>NOMBRE PRODUCTO</td>
                            <td>CATEGORIA</td>
                            <td>SUBCATEGORIA</td>
                            <td>UNIDAD</td>
                            <td>GRUPO</td>
                            <td>CUENTA</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($productos as $producto)
                        <tr x-data="window.__controller.dataTableController({{ $producto->id }})">
                            <td>{{ $producto->codigo_producto }}</td>
                            <td>{{ $producto->nombre_producto }}</td>

                            @foreach ($categorias as $categoria )
                                @if(  $producto->categoria_idCategoria == $categoria->id)
                                <td>{{ $categoria->nombre_categoria}}</td>
                                @endif
                            @endforeach

                            @foreach ($subcategorias as $subcategoria )
                                @if(  $producto->subcategoria_idSubcategoria == $subcategoria->id)
                                <td>{{ $subcategoria->nombre_subcategoria}}</td>
                                @endif
                            @endforeach

                            @foreach ($unidades as $unidad )
                                @if(  $producto->unidad_idUnidad == $unidad->id)
                                <td>{{ $unidad->nombre_unidad}}</td>
                                @endif
                            @endforeach

                            @foreach ($grupos as $grupo )
                                @if(  $producto->grupo_idGrupo == $grupo->id)
                                <td>{{ $grupo->nombre_grupo}}</td>
                                @endif
                            @endforeach
                            
                            @foreach ($cuentas as $cuenta )
                                @if(  $producto->cuenta_idCuenta == $cuenta->id)
                                <td>{{ $cuenta->nombre_cuenta}}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
