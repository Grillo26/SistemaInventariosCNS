<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('mesas') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Mesas') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pasillos</a></div>
            <div class="breadcrumb-item"><a href="{{ route('mesas') }}">Editar Pasillos</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-mesa action="updateMesa" :mesaId="request()->mesaId" />
    </div>
</x-app-layout>
