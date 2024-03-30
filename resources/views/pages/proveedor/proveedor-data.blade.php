<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Proveedor') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('proveedor') }}">Gestionar Proveedor</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:table.main name="proveedor" :model="$proveedor" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
