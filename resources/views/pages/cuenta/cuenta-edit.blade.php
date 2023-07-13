<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('cuentas') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Cuenta') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Cuenta</a></div>
            <div class="breadcrumb-item"><a href="{{ route('cuentas') }}">Editar Cuenta</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-cuenta action="updateCuenta" :cuentaId="request()->cuentaId" />
    </div>
</x-app-layout>
