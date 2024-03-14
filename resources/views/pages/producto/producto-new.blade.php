<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('producto') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Nuevo Artículo') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Artículo</a></div>
            <div class="breadcrumb-item"><a href="{{ route('producto') }}">Crear Artículo</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-producto action="createProducto" />
    </div>
</x-app-layout>
