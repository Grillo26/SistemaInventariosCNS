<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Cuentas') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Cuentas</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Gestionar Cuentas</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="cuenta" :model="$cuenta" />
    </div>
</x-app-layout>
