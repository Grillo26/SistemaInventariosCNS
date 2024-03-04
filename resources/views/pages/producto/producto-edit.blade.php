<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('producto') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Producto') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Grupo</a></div>
            <div class="breadcrumb-item"><a href="{{ route('producto') }}">Editar Grupo</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-producto action="updateProducto" :productoId="request()->productoId" />
    </div>
</x-app-layout>
