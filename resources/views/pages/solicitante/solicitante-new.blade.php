<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('solicitante') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Crear Solicitud') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Solicitante</a></div>
            <div class="breadcrumb-item"><a href="{{ route('solicitante.new') }}">Crear Solicitud</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-solicitante action="createSolicitante" />
    </div>
</x-app-layout>
