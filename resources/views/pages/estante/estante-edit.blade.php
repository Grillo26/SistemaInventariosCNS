<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('estantes') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Estante') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Estante</a></div>
            <div class="breadcrumb-item"><a href="{{ route('estantes') }}">Editar Estante</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:create-estante action="updateEstante" :estanteId="request()->estanteId" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
