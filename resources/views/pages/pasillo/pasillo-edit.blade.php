<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('pasillos') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Pasillos') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pasillos</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pasillos') }}">Editar Pasillos</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-pasillo action="updatePasillo" :pasilloId="request()->pasilloId" />
    </div>
</x-app-layout>
