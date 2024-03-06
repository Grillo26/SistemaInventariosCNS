@php
$links = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "icon" => "fas fa-chart-line",
        "is_multi" => false,
    ],

    [
        "href" => [
            [
                "section_text" => "Artículos",
                "icon" => "fas fa-box",
                "section_list" => [
                    ["href" => "producto.new", "text" => "Añadir Artículos"],
                    ["href" => "producto", "text" => "Gestionar Artículos"],
                    ["href" => "producto", "text" => "Salidas"],
                ]
    
            ]
        ],
        "text" => "Inventario",
        "is_multi" => true,
    ],
    
    [
        "href" => [
            [
                "section_text" => "Información",
                "icon" => "fas fa-database",
                "section_list" => [
                    ["href" => "grupos", "text" => "Grupos"],
                    ["href" => "cuentas", "text" => "Cuentas"],
                    ["href" => "unidades", "text" => "Unidades"],
                    ["href" => "comprobantes", "text" => "Comprobantes"],
                    ["href" => "mesas", "text" => "Mesas"],
                    ["href" => "pasillos", "text" => "Pasillo"],
                    ["href" => "dll", "text" => "Dll"],
                    ["href" => "solicitante", "text" => "Solicitante"],
                ]
    
            ]
        ],
        "text" => "Detalles de Artículos",
        "is_multi" => true,
    ],

    [
        "href" => "proveedor",
        "text" => "Proveedores",
        "icon" => "fas fa-truck",
        "is_multi" => false,
    ],

    [
    "href" => "solicitante",
        "text" => "Solicitudes",
        "icon" => "fas fa-paperclip",
        "is_multi" => false,
    ],

    
];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand p-3 mb-5">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="300px"src="{{URL::asset('img/cnsAlmacen.png')}}" alt="">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="{{URL::asset('img/cns.png')}}" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
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
        </ul>
        @endforeach
    </aside>
</div>
