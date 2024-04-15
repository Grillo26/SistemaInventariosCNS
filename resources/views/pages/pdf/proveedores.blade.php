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
        
        <h1>"REPORTE DE PROVEEDORES"</h1>
    </div>    
	<!--TABLE-->
    @if($proveedores->count())
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped text-sm text-gray-600">
					<thead>
                        <tr>
                            <th class="cursor-pointer" wire:click="order('id')">
                                    <a>Id Proveedor
                                </th>
                                <th class="cursor-pointer" wire:click="order('nombre_proveedor')">
                                    <a>Nombre Proveedor

                                </th>

                                <th class="cursor-pointer" wire:click="order('email')">
                                    <a>Correo Proveedor
                                </th>
                         </tr>
                    </thead>

                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr x-data="window.__controller.dataTableController({{ $proveedor->id }})">
                                <td>{{ $proveedor->id }}</td>
                                <td>{{ $proveedor->nombre_proveedor }}</td>
                                <td>{{ $proveedor->email }}</td>
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
