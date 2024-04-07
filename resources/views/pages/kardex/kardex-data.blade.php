<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestion de Kardex') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Inventario</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Gestión de Kardex</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:kardex/>         
        @else
        <livewire:unauthorized-message />
        @endrole
        
    </div>
</x-app-layout>
