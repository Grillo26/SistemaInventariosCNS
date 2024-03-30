<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Grupos') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Gestionar Grupos</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:table.main name="grupo" :model="$grupo" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
