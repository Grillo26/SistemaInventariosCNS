<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('pasillos') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Crear Pasillo') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pasillo</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pasillos.new') }}">Crear Pasillo</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:create-pasillo action="createPasillo" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
