<div>
    <x-data-table :data="$data" :model="$proveedors">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    Id Proveedor
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>

                <th><a wire:click.prevent="sortBy('nombre_proveedor')" role="button" href="#">
                    Nombre Proveedor
                    @include('components.sort-icon', ['field' => 'nombre_proveedor'])
                </a></th>

                <th><a wire:click.prevent="sortBy('n_telefono')" role="button" href="#">
                    Número de Telefono
                    @include('components.sort-icon', ['field' => 'n_telefono'])
                </a></th>

                <th><a wire:click.prevent="sortBy('email')" role="button" href="#">
                    Correo Proveedor
                    @include('components.sort-icon', ['field' => 'email'])
                </a></th>

                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($proveedors as $proveedor)
                <tr x-data="window.__controller.dataTableController({{ $proveedor->id }})">
                    <td>{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->nombre_proveedor }}</td>
                    <td>{{ $proveedor->n_telefono }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/proveedor/edit/{{$proveedor->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
