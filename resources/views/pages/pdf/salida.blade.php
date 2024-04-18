<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte Salida</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif; /* Cambio de fuente a Times New Roman */
            font-size: 12px; /* Cambio de tamaño de fuente a 12 */
            padding: 30px;
        }

        h1 {
            text-transform: uppercase;
            text-align: center; /* Centro el título */
            font-weight: bold; /* Hago el título en negrita */
        }
        h2 {
            text-align: center; /* Centro el subtítulo */
            text-decoration: underline; /* Agrego subrayado */
        }

        .señalador {
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid black;
            margin-right: 5px;
        }

        .tabla-container {
            text-align: center; /* Centro la tabla */
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto; /* Centra la tabla horizontalmente */
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
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
    <h2>REPORTE DE SALIDA DEL ALMACÉN - COMP N° {{$n_lote->n_comprobante}}</h2>


    <div class="señalador"></div>
    <h2 style="text-align:left ">DATOS EL ARTICULO: </h2>
    <div class="tabla-container"> <!-- Contenedor de la tabla -->
        <table>
            <tr style="background: #D0CECE;">
                <th>DATOS</th>
                <th>DETALLE</th>
            </tr>
        
            <tr>
                <td>Código de Producto</td>
                <td>{{$codigo_producto}}</td>
            </tr>
            <tr>
                <td>Nombre de Producto</td>
                <td>{{$nombre_producto}}</td>
            </tr>
            <tr>
                <td>Categoría</td>
                <td>{{$categoriaNombre}}</td>
            </tr>
            <tr>
                <td>Tipo</td>
                <td>{{$subcategoriak}}</td>
            </tr>
    
            <tr>
                <td>Descripción</td>
                <td>{{$descripcion}}</td>
            </tr>
            <tr>
                <td>Fecha de Salida</td>
                <td>{{$fecha_salida}}</td>
            </tr>
            <tr>
                <td>Hora de Salida</td>
                <td>{{$horaCreacion}}</td>
            </tr>
            <tr>
                <td>Cantidad</td>
                <td>{{$cantidad}}</td>
            </tr>
        </table>
    </div>
    <p>Se realizó la entrega a {{$recep}} el artículo {{$nombre_producto}}, en fecha {{$fecha_salida}} la cantidad total de {{$cantidad}} unidades, en la unidad de Almacenes de
        la Caja Nacional de Salud Distrital Yacuiba.
    </p>
    <br>


    <div class="firma">
        <p>{{ $user->name . ' ' . $user->lastname }}</p>
        <p>Entregado</p>
    </div>
    <div class="firma">
        <p>{{$recep}}</p>
        <p>Recibido</p>
    </div>
        
        
        
</body>
</html>
