<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Pasillos') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pasillos') }}">Gestionar pasillos</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="pasillo" :model="$pasillo" />
    </div>
</x-app-layout>
