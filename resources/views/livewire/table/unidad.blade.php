<div>
    <x-data-table :data="$data" :model="$unidads">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('nombre_unidad')" role="button" href="#">
                    Nombre de Unidad
                    @include('components.sort-icon', ['field' => 'nombre_unidad'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($unidads as $unidad)
                <tr x-data="window.__controller.dataTableController({{ $unidad->id }})">
                    <td>{{ $unidad->nombre_unidad }}</td>
                  
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/unidades/edit/{{$unidad->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
