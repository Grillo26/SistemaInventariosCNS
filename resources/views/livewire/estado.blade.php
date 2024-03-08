<div>
<x-slot name="header_content">
        <h1>{{ __('Gestionar Estados') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('estados') }}">Gestionar Estados</a></div>
        </div>
</x-slot>

 <div class="p-8 pt-4 mt-2 bg-white">
        <!--Butons-->
        <div class="flex pb-4 -ml-3">
            <a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
                Añadir Estado
                <span class="fas fa-plus"></span> 
            </a>
            <a href="#" class="ml-2 btn btn-success shadow-none">
                Exportar
                <span class="fas fa-file-export"></span> 
            </a>
        </div>

        <!--Modal-->
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">Crear Nuevo Estado</x-slot>
            <x-slot name="content">
                <!--número de Estado-->

                <div class="col-span-2 p-1">
                    <x-jet-label for="estado" value="{{ __('Nombre Estado') }}" />
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-text-width"></i>
                            </div>
                        </div>
                        <input id="estado" type="text" class="form-control phone-number" wire:model.defer="estado" required>
                    </div>
                    <x-jet-input-error for="estado" class="mt-2" />
                </div>

                
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
                <x-jet-danger-button wire:click="$set('open', false)" class="justify-center"> Cancelar</x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
  

        <x-notify-message on="saved" type="success" message="Estado creado correctamente!" /> 
        <x-notify-message on="edit" type="success" message="Estado modificado correctamente!" /> 

        <!--Options-->
        <div class="row mb-4">
            <div class="col form-inline">
                Por Páginas: &nbsp;
                <select  class="form-control" >
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                </select>
            </div>

            <div class="col">
                <input wire:model="search" class="form-control" type="text" placeholder="Buscar...">
            </div>
        </div>

        <!--TABLE-->
        @if($estados->count())
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-sm text-gray-600">
                    <thead>
                    <tr>
                        <th class="cursor-pointer" wire:click="order('estado')" >
                            <a>Número de Estado
                                @if ($sort == 'estado')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                        </th>

                        
                        <th><a>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($estados as $estado)
                    <tr x-data="window.__controller.dataTableController({{ $estado->id }})">
                        <td>{{ $estado->estado }}</td>
                        <td class="whitespace-no-wrap row-action--icon">
                            <a wire:click="editar({{$estado->id}})" role="button" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            <a x-on:click.prevent="deleteItem"  role="button"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                        </td>
                    </tr>
            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <div class="px-6 py-4">
                No se encontro ningún registro
            </div>
        @endif
    </div>
</div>
