<x-slot name="header_content">
        <h1>{{ __('Gestionar Artículos') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Gestionar Artículos</a></div>
        </div>
</x-slot>

<div class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
    <div class="p-8 pt-4 mt-2 bg-white">
        <!--Butons-->
        <div class="flex pb-4 -ml-3">
            <a wire:click="$set('open', true)"  class="-ml- btn btn-primary shadow-none">
                Añadir Artículo
                <span class="fas fa-plus"></span> 
            </a>
            <a href="#" class="ml-2 btn btn-success shadow-none">
                Exportar
                <span class="fas fa-file-export"></span> 
            </a>
        </div>

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

        <!--Modal-->
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">Crear Nuevo Artículo</x-slot>
            <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <!--Codigo de Producto-->
                <div class="mb-4">
                    <label>Coódigo del Artículo</label><br>
                    <x-jet-input wire:model.defer="codigoProd" type="text"  class="mt-1 block w-full border-gray-200 form-control shadow-none" placeholder="Ej. 223" autocomplete="off"/>
                </div>

                <!--Nombre de producto-->
                <div class="mb-4">
                    <label>Nombre del Artículo</label>
                    <x-jet-input wire:model.defer="nombreProd" type="text"  class="mt-1 block w-full border-gray-200 form-control shadow-none" placeholder="Ej. Medicamentos" autocomplete="off"/>
                </div>
            </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <!--unidad-->
                    <div class="mb-4">
                        <label>Unidad</label>
                        <select class="form-control"  wire:model.defer="unidadId">
                            <option value="" selected>Seleccione Unidad</option>
                            @foreach ( $unidades as $unidad )
                            <option  value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                            @endforeach   
                        </select>
                    </div>

                    <!--Grupo-->
                    <div class="mb-4">
                        <label>Grupo</label>
                        <select class="form-control" wire:model.defer="grupoId">
                            <option value="" selected >Seleccione Grupo</option>
                            @foreach ( $grupos as $grupo )
                            <option  value="{{$grupo->id}}">{{$grupo->nombre_grupo}}</option>
                            @endforeach 
                        </select> 
                    </div>

                    <!--Cuenta.-->
                    <div class="mb-4">
                        <label>Cuenta</label>
                        <select class="form-control" wire:model.defer="cuentaId">
                            <option value="" selected >Seleccione Cuenta</option>
                            @foreach ( $cuentas as $cuenta )
                            <option  value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
                            @endforeach   
                        </select>
                    </div>

                </div>
  
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
                <x-jet-danger-button wire:click="$set('open', false)" class="justify-center"> Cancelar</x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        <!--Modal2 Para Registrar Salidas -->
        <x-jet-dialog-modal wire:model="open2">
            <x-slot name="title" >Registrar Salida del Artículo</x-slot>
            <x-slot name="content">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Codigo de Producto-->
                <div class="mb-2">
                    <label>Código del Artículo</label><br>
                    <x-jet-input wire:model.defer="codigoProd" type="text"  class="block w-full border-gray-200 form-control shadow-none" disabled/>
                </div>

                <!--Nombre de producto-->
                <div class="mb-2">
                    <label>Nombre del Artículo</label>
                    <x-jet-input wire:model.defer="nombreProd" type="text"  class="block w-full border-gray-200 form-control shadow-none" disabled/>
                </div>

                <!--unidad-->
                <div class="mb-4">
                    <label>Unidad</label>
                    <select class="form-control"  wire:model.defer="unidadId" disabled>
                        <option value="" selected>Seleccione Unidad</option>
                        @foreach ( $unidades as $unidad )
                        <option  value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                        @endforeach   
                    </select>
                </div>

                
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <!--Grupo-->
                <div class="mb-4">
                    <label>Grupo</label>
                    <select class="form-control" wire:model.defer="grupoId" disabled>
                        <option value="" selected >Seleccione Grupo</option>
                        @foreach ( $grupos as $grupo )
                        <option  value="{{$grupo->id}}">{{$grupo->nombre_grupo}}</option>
                        @endforeach 
                    </select> 
                </div>

                <!--Cuenta.-->
                <div class="mb-4">
                    <label>Cuenta</label>
                    <select class="form-control" wire:model.defer="cuentaId" disabled>
                        <option value="" selected >Seleccione Cuenta</option>
                        @foreach ( $cuentas as $cuenta )
                        <option  value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
                        @endforeach   
                    </select>
                </div>

                <!--Cuenta A.-->
                <div class="mb-4">
                    <label>Cuenta A.</label>
                    <select class="form-control" wire:model.defer="grupoId" disabled>
                        @foreach ( $grupos as $grupo )
                        <option  value="{{$grupo->id}}">{{$grupo->cuenta_a}}</option>
                        @endforeach   
                    </select>
                </div>


            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <!--Partida P.-->
                <div class="mb-4">
                    <label>Partida P.</label>
                    <select class="form-control" wire:model.defer="grupoId" disabled>
                        @foreach ( $grupos as $grupo )
                        <option  value="{{$grupo->id}}">{{$grupo->partida_a}}</option>
                        @endforeach   
                    </select>
                </div>

                <!--Codigo Cuenta.-->
                <div class="mb-4">
                    <label>Código Cuenta</label>
                    <select class="form-control" wire:model.defer="grupoId" disabled>
                        @foreach ( $cuentas as $cuenta )
                        <option  value="{{$cuenta->id}}">{{$cuenta->codigo_cuenta}}</option>
                        @endforeach    
                    </select>
                </div>

                <!--precio U-->
                <div class="mb-4">
                    <label>Precio U.</label>
                    <select class="form-control" wire:model.defer="grupoId" disabled>
                        @foreach ( $cuentas as $cuenta )
                        <option  value="{{$cuenta->id}}">{{$cuenta->codigo_cuenta}}</option>
                        @endforeach    
                    </select>
                </div>

            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                <!--unidad-->
                <div class="mb-3">
                    <label>Unidad</label>
                    <select class="form-control"  wire:model.defer="unidadId">
                        <option value="" selected>Seleccione Unidad</option>
                        @foreach ( $unidades as $unidad )
                        <option  value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                        @endforeach   
                    </select>
                </div>

                <!--Nro comprobante-->
                <div class="mb-2">
                    <label>Nro. Comp.</label>
                    <select class="form-control"  wire:model.defer="unidadId">
                        <option value="" selected>Comprobante</option>
                        @foreach ( $comprobantes as $comprobante )
                        <option  value="{{$comprobante->id}}">{{$comprobante->n_comprobante}}</option>
                        @endforeach   
                    </select>
                </div>


                <!--Fecha-->
                <div class="mt-4 pt-1 form-group ">
                    <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Inserte Fecha">
                    </div>
                </div>

                <!--Cantidad-->
                <div class="mb-4">
                    <label>Cantidad</label><br>
                    <x-jet-input  type="text" class=" block w-full border-gray-200 form-control shadow-none" placeholder="Ej. 100" autocomplete="off"/>
                </div>


            </div>
  
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
                <x-jet-danger-button wire:click="$set('open2', false)" class="justify-center"> Cancelar</x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        <!--Modal3 Para Registrar Entradas -->
        <x-jet-dialog-modal wire:model="open3">
            <x-slot name="title" >Registrar Entrada del Artículo</x-slot>
            <x-slot name="content">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Codigo de Producto-->
                <div class="mb-2">
                    <label>Código del Artículo</label><br>
                    <x-jet-input wire:model.defer="codigoProd" type="text"  class="block w-full border-gray-200 form-control shadow-none" disabled/>
                </div>

                <!--Nombre de producto-->
                <div class="mb-2">
                    <label>Nombre del Artículo</label>
                    <x-jet-input wire:model.defer="nombreProd" type="text"  class="block w-full border-gray-200 form-control shadow-none" disabled/>
                </div>

                <!--Grupo-->
                <div class="mb-4">
                    <label>Grupo</label>
                    <select class="form-control" wire:model.defer="grupoId" disabled>
                        <option value="" selected >Seleccione Grupo</option>
                        @foreach ( $grupos as $grupo )
                        <option  value="{{$grupo->id}}">{{$grupo->nombre_grupo}}</option>
                        @endforeach 
                    </select> 
                </div>                
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Cuenta.-->
                <div class="mb-4">
                    <label>Cuenta</label>
                    <select class="form-control" wire:model.defer="cuentaId" disabled>
                        <option value="" selected >Seleccione Cuenta</option>
                        @foreach ( $cuentas as $cuenta )
                        <option  value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
                        @endforeach   
                    </select>
                </div>

                <!--unidad-->
                <div class="mb-4">
                    <label>Unidad</label>
                    <select class="form-control"  wire:model.defer="unidadId" disabled>
                        <option value="" selected>Seleccione Unidad</option>
                        @foreach ( $unidades as $unidad )
                        <option  value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                        @endforeach   
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <!--Precio-->
                <div class="mb-4">
                    <label>Precio(Bs)</label><br>
                    <x-jet-input  type="text" class=" block w-full border-gray-200 form-control shadow-none" placeholder="Ej. 100" autocomplete="off"/>
                </div>

                <!--Cantidad-->
                <div class="mb-4">
                    <label>Cantidad(Unidad)</label><br>
                    <x-jet-input  type="text" class=" block w-full border-gray-200 form-control shadow-none" placeholder="Ej. 20" autocomplete="off"/>
                </div>

                <!--Fecha de vencimiento-->
                <div class="mt-4 pt-1 form-group ">
                    <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha de Vencimiento">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!--Proveedor-->
                <div class="mb-4">
                    <label>Proveedor</label><br>
                    <x-jet-input  type="text" class=" block w-full border-gray-200 form-control shadow-none" placeholder="Ej. Coca Cola" autocomplete="off"/>
                </div>

                <!--Fecha de vencimiento-->
                <div class="mt-4 pt-1 form-group ">
                    <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Inserte Fecha">
                    </div>
                </div>

                <!--Ady-->
                <div class="mb-2">
                    <label>Ady</label>
                    <select class="form-control"  wire:model.defer="unidadId">
                        <option value="" selected>Ady</option>
                        @foreach ( $comprobantes as $comprobante )
                        <option  value="{{$comprobante->id}}">{{$comprobante->n_comprobante}}</option>
                        @endforeach   
                    </select>
                </div>

            </div>
  
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="guardar" class="justify-center"> Guardar</x-jet-button>
                <x-jet-danger-button wire:click="$set('open3', false)" class="justify-center"> Cancelar</x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        <x-notify-message on="saved" type="success" message="Artículo creado correctamente!" /> 
        <x-notify-message on="edit" type="success" message="Artículo modificado correctamente!" /> 


        <!--TABLE-->
        @if($productos->count())
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-sm text-gray-600">
                    <thead>
                    <tr>
                        <th class="cursor-pointer" wire:click="order('codigo_producto')" >
                            <a>Código
                                @if ($sort == 'codigo_producto')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif
                        </th>
                        <th class="cursor-pointer" wire:click="order('nombre_producto')" >
                            <a>Nombre
                                @if ($sort == 'nombre_producto')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif</th>
                        <th class="cursor-pointer" wire:click="order('unidad_idUnidad')" >
                            <a>Unidad
                            @if ($sort == 'unidad_idUnidad')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif</th>
                        <th class="cursor-pointer" wire:click="order('grupo_idGrupo')" >
                            <a>Grupo
                            @if ($sort == 'grupo_idGrupo')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="text-muted fas fa-sort"></i>
                                @endif</th>
                        <th class="cursor-pointer" wire:click="order('cuenta_idCuenta')" >
                            <a>Cuenta
                            @if ($sort == 'cuenta_idCuenta')
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
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->codigo_producto }}</td>
                        <td>{{ $producto->nombre_producto}}</td>

                        @foreach ($unidades as $unidad )
                        @if(  $producto->unidad_idUnidad == $unidad->id)
                        <td>{{ $unidad->nombre_unidad}}</td>
                        @endif
                        @endforeach

                        @foreach ($grupos as $grupo )
                        @if(  $producto->grupo_idGrupo == $grupo->id)
                        <td>{{ $grupo->nombre_grupo}}</td>
                        @endif
                        @endforeach

                        @foreach ($cuentas as $cuenta )
                        @if(  $producto->cuenta_idCuenta == $cuenta->id)
                        <td>{{ $cuenta->nombre_cuenta}}</td>
                        @endif
                        @endforeach

                        <td class="whitespace-no-wrap row-action--icon" x-data="window.__controller.dataTableController({{ $producto->id }})">
                            <a wire:click="entrada({{$producto->id}})" role="button" class="ml-3"><i class="fa fa-16px fa-sign-in-alt" title="Registrar Entrada"></i></a>
                            <a wire:click="editar({{$producto->id}})" role="button" class="ml-3"><i class="fa fa-16px fa-pen" title="Editar"></i></a>
                            <a x-on:click.prevent="deleteItem"  role="button" class="ml-3"><i class="fa fa-16px fa-trash text-red-500" title="Eliminar"></i></a>
                            <a wire:click="salida({{$producto->id}})" role="button" class="ml-3"><i class="fa fa-16px fa-sign-out-alt" title="Registrar Salida"></i></a>
                        </td>
                    </tr>
            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <div class="px-6 py-4">
                No se encontro ningún registro con {{$search}}
            </div>
        @endif
    </div>
</div>