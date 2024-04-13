<div>
    <x-data-table :data="$data" :model="$productos, $unidades, $cuentas, $categorias, $subcategorias">
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

                <th><a wire:click.prevent="sortBy('categoria_idCategoria')" role="button" href="#">
                    Categoría
                    @include('components.sort-icon', ['field' => 'categoria_idCategoria'])
                </a></th>

                <th><a wire:click.prevent="sortBy('subcategoria_idSubcategoria')" role="button" href="#">
                    SubCategoría
                    @include('components.sort-icon', ['field' => 'subcategoria_idSubcategoria'])
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
                    
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/producto/edit/{{$producto->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
