<div>
    <x-data-table :data="$data" :model="$estantes">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('n_estante')" role="button" href="#">
                    Número de Estante
                    @include('components.sort-icon', ['field' => 'n_estante'])
                </a></th>

                <th><a wire:click.prevent="sortBy('descripcion')" role="button" href="#">
                    Descripción
                    @include('components.sort-icon', ['field' => 'descripcion'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($estantes as $estante)
                <tr x-data="window.__controller.dataTableController({{ $estante->id }})">
                    <td>{{ $estante->n_estante }}</td>
                    <td>{{ $estante->descripcion }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/estantes/edit/{{$estante->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
