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
        <img src="{{ asset('images/logo1.png') }}" class="logo1" alt="">
            
        <img src="{{ asset('images/logo2.png') }}" class="logo2" alt="">
        <h1>REPORTE DE SALIDA DE PRODUCTOS CNS"

        </h1>
    </div>
    <h1>Tabla de Registros de entradas</h1>
    

    <table>
        <thead>
            <tr>
                <th>Fecha de adquisicion</th>
                <th>ID de producto</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
            <tr>
                <td>{{ $registro->fecha_salida }}</td>
                <td>{{ $registro->producto_idProducto }}</td>
                

                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
