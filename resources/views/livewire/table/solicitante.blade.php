<div>
    <x-data-table :data="$data" :model="$solicitantes">
        <x-slot name="head">
            <tr>
               
                <th><a wire:click.prevent="sortBy('nombre_u')" role="button" href="#">
                    Número de Pasillo
                    @include('components.sort-icon', ['field' => 'nombre_u'])
                </a></th>

                <th><a wire:click.prevent="sortBy('codigo_u')" role="button" href="#">
                    Número de Pasillo
                    @include('components.sort-icon', ['field' => 'codigo_u'])
                </a></th>

                <th><a wire:click.prevent="sortBy('codigo_u2')" role="button" href="#">
                    Número de Pasillo
                    @include('components.sort-icon', ['field' => 'codigo_u2'])
                </a></th>
        
                <th>Acciones</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($solicitantes as $solicitante)
                <tr x-data="window.__controller.dataTableController({{ $solicitante->id }})">
                    <td>{{ $solicitante->nombre_u }}</td>
                    <td>{{ $solicitante->codigo_u }}</td>
                    <td>{{ $solicitante->codigo_u2 }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/solicitante/edit/{{$solicitante->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot> 
    </x-data-table>
</div>
