<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('dll') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Crear Dll') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('dll.new') }}">Crear Mesa</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-dll action="createDll" />
    </div>
</x-app-layout>
