<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Solicitantes') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('solicitante') }}">Gestionar Solicitantes</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="solicitante" :model="$solicitante" />
    </div>
</x-app-layout>
