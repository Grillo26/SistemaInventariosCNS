<div>
<x-slot name="header_content">
        <h1>{{ __('Gestionar Comprobantes') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Gestionar Comprobantes</a></div>
        </div>
</x-slot>

 <div class="p-8 pt-4 mt-2 bg-white">
        <!--Butons-->
        <div class="flex pb-4 -ml-3">
            <a wire:click="$set('open', true)" class="-ml- btn btn-primary shadow-none">
                Añadir Comprobate
                <span class="fas fa-plus"></span> 
            </a>
            <a href="#" class="ml-2 btn btn-success shadow-none">
                Exportar
                <span class="fas fa-file-export"></span> 
            </a>
        </div>

        <!--Modal-->
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">Crear Nuevo Comprobante</x-slot>
            <x-slot name="content">
                <!--número de Comprobante-->
                <div class="mb-4">
                    <label>Número de Comprobante</label><br>
                    <x-jet-input wire:model.defer="nComp" type="text"  class="mt-1 block w-full border-gray-200 form-control shadow-none" placeholder="Ej. 445" autocomplete="off"/>
                </div>

                <!--Grupo-->
                <div class="mb-4">
                    <label>Detalle del Comprobate</label><br>
                    <x-jet-input wire:model.defer="detall" type="text"  class="mt-1 block w-full border-gray-200 form-control shadow-none" placeholder="Comprbante Kardex" autocomplete="off"/>
                </div>
  
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
                <x-jet-danger-button wire:click="$set('open', false)" class="justify-center"> Cancelar</x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
  

        <x-notify-message on="saved" type="success" message="Comprobante creado correctamente!" /> 
        <x-notify-message on="edit" type="success" message="Comprobante modificado correctamente!" /> 

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
        @if($comprobantes->count())
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-sm text-gray-600">
                    <thead>
                    <tr>
                        <th class="cursor-pointer" wire:click="order('n_comprobante')" >
                            <a>Número de Comprobante
                                @if ($sort == 'n_comprobante')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                        </th>
                        <th class="cursor-pointer" wire:click="order('detalle')" >
                            <a>Detalle Comprobante
                                @if ($sort == 'detalle')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif</th>

                        
                        <th><a>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($comprobantes as $comprobante)
                    <tr x-data="window.__controller.dataTableController({{ $comprobante->id }})">
                        <td>{{ $comprobante->n_comprobante }}</td>
                        <td>{{ $comprobante->detalle}}</td>
                        <td class="whitespace-no-wrap row-action--icon">
                            <a wire:click="editar({{$comprobante->id}})" role="button" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
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
