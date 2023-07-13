<x-app-layout>
    <x-slot name="header_content">
    <div class="section-header-back">
        <a href="{{ route('grupos') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>{{ __('Crear Grupo') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Grupo</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Crear Grupo</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-grupo action="createGrupo" />
    </div>
</x-app-layout>
