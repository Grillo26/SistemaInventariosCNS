<div>
    <x-data-table :data="$data" :model="$solicitantes, $productos, $estados, $users">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    Id Solicitud
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>

                <th><a wire:click.prevent="sortBy('referencia')" role="button" href="#">
                    Referencia
                    @include('components.sort-icon', ['field' => 'referencia'])
                </a></th>

                <th><a wire:click.prevent="sortBy('detalle')" role="button" href="#">
                    Detalle
                    @include('components.sort-icon', ['field' => 'detalle'])
                </a></th>

                <th><a wire:click.prevent="sortBy('cantidad')" role="button" href="#">
                    Cantidad
                    @include('components.sort-icon', ['field' => 'cantidad'])
                </a></th>

                <th><a wire:click.prevent="sortBy('producto_idProducto')" role="button" href="#">
                    Código Artículo
                    @include('components.sort-icon', ['field' => 'producto_idProducto'])
                </a></th>

                <th><a wire:click.prevent="sortBy('producto_idProducto')" role="button" href="#">
                    Nombre Artículo
                    @include('components.sort-icon', ['field' => 'producto_idProducto'])
                </a></th>
                @role('Admin')
                <th><a wire:click.prevent="sortBy('user_id')" role="button" href="#">
                    Solicitante
                    @include('components.sort-icon', ['field' => 'user_id'])
                </a></th>
                @endrole

                <th><a wire:click.prevent="sortBy('estado')" role="button" href="#">
                    Estado
                    @include('components.sort-icon', ['field' => 'estado'])
                </a></th>

                @role('Admin')
                <th>Acciones</th>
                @endrole
            </tr>
        </x-slot>
        <x-slot name="body">
            <!--Si es Administrador-->
            @role('Admin')
                @foreach ($solicitantes as $solicitante)
                    
                    <tr x-data="window.__controller.dataTableController({{ $solicitante->id }})">
                        <td>{{ $solicitante->id }}</td>
                        <td>{{ $solicitante->referencia }}</td>
                        <td>{{ $solicitante->detalle }}</td>
                        <td>{{ $solicitante->cantidad }}</td>
                        @foreach ($productos as $producto)
                            @if($solicitante->producto_idProducto == $producto->id)
                                <td>{{ $producto->codigo_producto }}</td>
                                <td>{{ $producto->nombre_producto }}</td>
                            @endif
                        @endforeach

                        @foreach ($users as $user)
                            @if($solicitante->user_id == $user->id)
                                <td>{{ $user->name . ' ' . $user->lastname }}</td> <!--Concatena el nombre y el apellido-->
                            @endif
                        @endforeach

                        @foreach ($estados as $estado)
                            @if($solicitante->estado_idEstado == $estado->id)
                                <td>{{ $estado->estado }}</td>
                            @endif
                        @endforeach
                        <td class="whitespace-no-wrap row-action--icon">
                            <a role="button" href="/solicitante/edit/{{ $solicitante->id }}" class="mr-3">
                                <i class="fa fa-16px fa-pen"></i>
                            </a>
                            <a role="button" x-on:click.prevent="deleteItem" href="#">
                                <i class="fa fa-16px fa-trash text-red-500"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
            <!--Si es solo un solicitante-->
            @foreach ($solicitantes as $solicitante)
                @if($solicitante->user_id === auth()->id())
                    <tr x-data="window.__controller.dataTableController({{ $solicitante->id }})">
                        <td>{{ $solicitante->id }}</td>
                        <td>{{ $solicitante->referencia }}</td>
                        <td>{{ $solicitante->detalle }}</td>
                        <td>{{ $solicitante->cantidad }}</td>
                        @foreach ($productos as $producto)
                            @if($solicitante->producto_idProducto == $producto->id)
                                <td>{{ $producto->codigo_producto }}</td>
                                <td>{{ $producto->nombre_producto }}</td>
                            @endif
                        @endforeach
                        @foreach ($estados as $estado)
                            @if($solicitante->estado_idEstado == $estado->id)
                                <td>{{ $estado->estado }}</td>
                            @endif
                        @endforeach
                        <!--
                        <td class="whitespace-no-wrap row-action--icon">
                            <a role="button" href="/solicitante/edit/{{ $solicitante->id }}" class="mr-3">
                                <i class="fa fa-16px fa-pen"></i>
                            </a>
                            <a role="button" x-on:click.prevent="deleteItem" href="#">
                                <i class="fa fa-16px fa-trash text-red-500"></i>
                            </a>
                        </td>-->
                    </tr>
                @endif
            @endforeach

            @endrole
            
        </x-slot>

    </x-data-table>
</div>
