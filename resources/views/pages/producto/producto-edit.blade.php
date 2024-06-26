<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('producto') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Artículo') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Artículo</a></div>
            <div class="breadcrumb-item"><a href="{{ route('producto') }}">Editar Artículo</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:create-producto action="updateProducto" :productoId="request()->productoId" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
