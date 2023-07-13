<?php

namespace App\Traits;


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
                            'export_text' => 'Exportar'
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
                            'export_text' => 'Exportar'
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
                            'export_text' => 'Exportar'
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
                            'export_text' => 'Exportar'
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