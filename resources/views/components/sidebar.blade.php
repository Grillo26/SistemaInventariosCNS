@php
// Obtener el usuario actualmente autenticado
$user = Auth::user();

// Verificar si el usuario tiene el rol de Admin
$isAdmin = $user->hasRole('Admin');

$links = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "icon" => "fas fa-chart-line",
        "is_multi" => false,
        "is_admin" => true,
    ],

    [
        "href" => [
            [
                "section_text" => "Artículos",
                "icon" => "fas fa-box",
                "section_list" => [
                    ["href" => "stock", "text" => "Verificar Stock"],
                    ["href" => "ubicacion", "text" => "Ubicación de Artículo"],
                    ["href" => "producto.new", "text" => "Nuevo Artículo"],
                    ["href" => "producto", "text" => "Gestionar Artículos"],
                    ["href" => "entradas", "text" => "Entrada de Artículos"],
                    ["href" => "salidas", "text" => "Salida de Artículos"],
                ]
    
            ]
        ],
        "text" => "Inventario",
        "is_multi" => true,
        "is_admin" => true,
    ],

    [
        "href" => [
            [
                "section_text" => "Grupos",
                "icon" => "fas fa-users",
                "section_list" => [
                    ["href" => "grupos.new", "text" => "Añadir Grupo"],
                    ["href" => "grupos", "text" => "Gestionar Grupos"],
                ]
    
            ],
            [
                "section_text" => "Cuentas",
                "icon" => "fas fa-list-ol",
                "section_list" => [
                    ["href" => "cuentas.new", "text" => "Añadir Cuenta"],
                    ["href" => "cuentas", "text" => "Gestionar Cuentas"],
                ]
    
            ],
            [
                "section_text" => "Unidades",
                "icon" => "fas fa-building",
                "section_list" => [
                    ["href" => "unidades.new", "text" => "Añadir Unidad"],
                    ["href" => "unidades", "text" => "Gestionar Unidades"],
                ]
    
            ],
        ],
        "text" => "Categorías",
        "is_multi" => true,
        "is_admin" => $isAdmin,
    ],
    
    [
        "href" => [
            [
                "section_text" => "Información",
                "icon" => "fas fa-database",
                "section_list" => [
                    ["href" => "pasillos", "text" => "Pasillos"],
                    ["href" => "mesas", "text" => "Mesas"],
                    ["href" => "estantes", "text" => "Estantes"],
                    ["href" => "comprobantes", "text" => "Comprobantes"],
                    ["href" => "dll", "text" => "Dll"],
                    ["href" => "estados", "text" => "Estados"],
                ]
    
            ]
        ],
        "text" => "Detalles de Artículos",
        "is_multi" => true,
        "is_admin" => $isAdmin,
    ],

    [
        "href" => "proveedor",
        "text" => "Proveedores",
        "icon" => "fas fa-truck",
        "is_multi" => false,
        "is_admin" => $isAdmin,
    ],

    [
    "href" => "solicitante",
        "text" => "Solicitudes",
        "icon" => "fas fa-paperclip",
        "is_multi" => false,
        "is_admin" => true,
    ],

    [
    "href" => "reporte",
        "text" => "Reportes",
        "icon" => "fas fa-file-pdf",
        "is_multi" => false,
        "is_admin" => $isAdmin,
    ],

    [
        "href" => [
            [
                "section_text" => "Usuarios",
                "icon" => "fas fa-user",
                "section_list" => [
                    ["href" => "user", "text" => "Usarios"],
                    ["href" => "user.new", "text" => "Nuevo Usuario"],
                    
                ]
    
            ]
        ],
        "text" => "Administración de Usuarios",
        "is_multi" => true,
        "is_admin" => $isAdmin,
    ],

    
];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand p-3 mb-5">
            @role('Admin')
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="300px"src="{{URL::asset('img/cnsAlmacen.png')}}" alt="">
            </a>
            @else
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="300px"src="{{URL::asset('img/cnsUser.png')}}" alt="">
            </a>
            @endrole
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="{{URL::asset('img/cns.png')}}" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
            @if(!$link->is_admin)

            @else
                <li class="menu-header">{{ $link->text }}</li>
                @if (!$link->is_multi)
                <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($link->href) }}"><i class="{{ $link->icon }}"></i><span> {{ $link->text}} </span></a>
                </li>
                @else
                    @foreach ($link->href as $section)
                        @php
                        $routes = collect($section->section_list)->map(function ($child) {
                            return Request::routeIs($child->href);
                        })->toArray();

                        $is_active = in_array(true, $routes);
                        @endphp

                        <li class="dropdown {{ ($is_active) ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $section->icon}}"></i> <span>{{ $section->section_text }}</span></a>
                            <ul class="dropdown-menu">
                                @foreach ($section->section_list as $child)
                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
            @endif
        </ul>
        @endforeach
    </aside>
</div>
