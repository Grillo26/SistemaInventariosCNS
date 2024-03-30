<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Artículos') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('producto') }}">Gestionar Artículos</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:table.main name="producto" :model="$producto" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
