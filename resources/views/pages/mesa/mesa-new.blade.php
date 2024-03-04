<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('mesas') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Crear Mesa') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Crear Mesa</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-mesa action="createMesa" />
    </div>
</x-app-layout>
