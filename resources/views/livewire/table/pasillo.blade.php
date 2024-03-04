<div>
    <x-data-table :data="$data" :model="$pasillos">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('n_pasillo')" role="button" href="#">
                    Número de Pasillo
                    @include('components.sort-icon', ['field' => 'n_pasillo'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($pasillos as $pasillo)
                <tr x-data="window.__controller.dataTableController({{ $pasillo->id }})">
                    <td>{{ $pasillo->n_pasillo }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/pasillos/edit/{{$pasillo->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
