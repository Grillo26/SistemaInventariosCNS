<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('unidades') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Unidad') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Unidad</a></div>
            <div class="breadcrumb-item"><a href="{{ route('unidades') }}">Editar Unidad</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:create-unidad action="updateUnidad" :unidadId="request()->unidadId" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
