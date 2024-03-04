<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('proveedor') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Crear Proveedor') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Proveedor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('proveedor.new') }}">Crear Proveedor</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-proveedor action="createProveedor" />
    </div>
</x-app-layout>
