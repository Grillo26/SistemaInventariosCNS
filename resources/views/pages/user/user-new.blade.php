<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Crear Usuario') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Usuario</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Crear Usuario</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:create-user action="createUser" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
