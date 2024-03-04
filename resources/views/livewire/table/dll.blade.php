<div>
    <x-data-table :data="$data" :model="$dlls">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('nombre')" role="button" href="#">
                    Nombre Dll
                    @include('components.sort-icon', ['field' => 'nombre'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($dlls as $dll)
                <tr x-data="window.__controller.dataTableController({{ $dll->id }})">
                    <td>{{ $dll->nombre }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/dll/edit/{{$dll->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
