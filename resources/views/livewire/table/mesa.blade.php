<div>
    <x-data-table :data="$data" :model="$mesas">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('n_mesa')" role="button" href="#">
                    Número de Mesa
                    @include('components.sort-icon', ['field' => 'n_mesa'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($mesas as $mesa)
                <tr x-data="window.__controller.dataTableController({{ $mesa->id }})">
                    <td>{{ $mesa->n_mesa }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/mesas/edit/{{$mesa->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
