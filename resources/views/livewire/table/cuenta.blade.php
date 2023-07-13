<div>
    <x-data-table :data="$data" :model="$cuentas">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('nombre_cuenta')" role="button" href="#">
                    Nombre de Cuenta
                    @include('components.sort-icon', ['field' => 'nombre_cuenta'])
                </a></th>

                <th><a wire:click.prevent="sortBy('codigo_cuenta')" role="button" href="#">
                    Codigo de Cuenta
                    @include('components.sort-icon', ['field' => 'codigo_cuenta'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($cuentas as $cuenta)
                <tr x-data="window.__controller.dataTableController({{ $cuenta->id }})">
                    <td>{{ $cuenta->nombre_cuenta }}</td>
                    <td>{{ $cuenta->codigo_cuenta }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/cuentas/edit/{{$cuenta->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
