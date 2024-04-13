<?php

namespace App\Traits;
use App\Models\Grupo;
use App\Models\Unidad;
use App\Models\Cuenta;
use App\Models\Estado;
use App\Models\Producto;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Subcategoria;



trait WithDataTable {
    
    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('user.new'),
                            'create_new_text' => 'Nuevo Usuario',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'grupo':
                $grupos = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.grupo',
                    "grupos" => $grupos,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('grupos.new'),
                            'create_new_text' => 'Nuevo Grupo',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'cuenta':
                $cuentas = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.cuenta',
                    "cuentas" => $cuentas,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('cuentas.new'),
                            'create_new_text' => 'Nueva cuenta',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;


            case 'unidad':
                $unidads = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.unidad',
                    "unidads" => $unidads,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('unidades.new'),
                            'create_new_text' => 'Nueva Unidad',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'mesa':
                $mesas = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.mesa',
                    "mesas" => $mesas,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('mesas.new'),
                            'create_new_text' => 'Nueva Mesa',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'pasillo':
                $pasillos = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.pasillo',
                    "pasillos" => $pasillos,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('pasillos.new'),
                            'create_new_text' => 'Nuevo Pasillo',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'estante':
                $estantes = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.estante',
                    "estantes" => $estantes,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('estantes.new'),
                            'create_new_text' => 'Nuevo Estante',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'proveedor':
                $proveedors = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
    
                return [
                    "view" => 'livewire.table.proveedor',
                    "proveedors" => $proveedors,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('proveedor.new'),
                            'create_new_text' => 'Nuevo Proveedor',
                            'export' => route('reporte.proveedores'),
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'dll':
                $dlls = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
        
                return [
                    "view" => 'livewire.table.dll',
                    "dlls" => $dlls,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('dll.new'),
                            'create_new_text' => 'Nuevo Dll',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                            ]
                        ])
                    ];
                break;

            case 'solicitante':
                $solicitantes = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                $estados = Estado::get(); //Extrayendo de otra tabl
                $productos = Producto::get(); //Extrayendo de otra tabl
                $users = User::get(); //Extrayendo de otra tabl
            
                return [
                    "view" => 'livewire.table.solicitante',
                    "solicitantes" => $solicitantes,
                    "productos" => $productos,
                    "estados" => $estados,
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('solicitante.new'),
                            'create_new_text' => 'Nueva Solicitud',
                            'export' => '#',
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
                break;

            case 'producto':
                $productos = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                $grupos = Grupo::get(); //Extrayendo de otra tabl
                $unidades = Unidad::get(); //Extrayendo de otra tabl
                $cuentas = Cuenta::get(); //Extrayendo de otra tabl
                $categorias = Categoria::get(); //Extrayendo de otra tabl
                $subcategorias = Subcategoria::get(); //Extrayendo de otra tabl

                
                return [
                    "view" => 'livewire.table.producto',
                    "productos" => $productos,
                    "grupos" => $grupos,
                    "unidades" => $unidades,
                    "cuentas" => $cuentas,
                    "categorias" => $categorias,
                    "subcategorias" => $subcategorias,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('producto.new'),
                            'create_new_text' => 'Nuevo Artículo',
                            'export' => route('articulos.pdf'),
                            'export_text' => 'Generar Reporte'
                        ]
                    ])
                ];
            break;
           



            default:
            #<---------- code...
            break;
        }
    }
}