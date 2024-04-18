<div>
    <x-data-table :data="$data" :model="$grupos">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('nombre_grupo')" role="button" href="#">
                    Nombre del Grupo
                    @include('components.sort-icon', ['field' => 'nombre_grupo'])
                </a></th>

        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($grupos as $grupo)
                <tr x-data="window.__controller.dataTableController({{ $grupo->id }})">
                    <td>{{ $grupo->nombre_grupo }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/grupos/edit/{{$grupo->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
