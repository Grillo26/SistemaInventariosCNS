<div>
    <x-data-table :data="$data" :model="$productos">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('codigo_producto')" role="button" href="#">
                    Código del Producto
                    @include('components.sort-icon', ['field' => 'codigo_producto'])
                </a></th>

                <th><a wire:click.prevent="sortBy('nombre_producto')" role="button" href="#">
                    Nombre del Producto
                    @include('components.sort-icon', ['field' => 'nombre_producto'])
                </a></th>

                <th><a wire:click.prevent="sortBy('unidad_idUnidad')" role="button" href="#">
                    Unidad
                    @include('components.sort-icon', ['field' => 'unidad_idUnidad'])
                </a></th>

                <th><a wire:click.prevent="sortBy('grupo_idGrupo')" role="button" href="#">
                    Grupo
                    @include('components.sort-icon', ['field' => 'grupo_idGrupo'])
                </a></th>

                <th><a wire:click.prevent="sortBy('cuenta_idCuenta')" role="button" href="#">
                    Cuenta
                    @include('components.sort-icon', ['field' => 'cuenta_idCuenta'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($productos as $producto)
                <tr x-data="window.__controller.dataTableController({{ $producto->id }})">
                    <td>{{ $producto->codigo_producto }}</td>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->unidad_idUnidad }}</td>
                    <td>{{ $producto->grupo_idGrupo }}</td>
                    <td>{{ $producto->idCuenta }}</td>
                    
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/producto/edit/{{$producto->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
