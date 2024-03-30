
<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Usuarios') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Usuarios</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Gestionar Usuarios</a></div>
        </div>
    </x-slot>

    <div>

        @role('Admin')
            <livewire:table.main name="user" :model="$user" />
        @else
            <livewire:unauthorized-message />
        @endrole
        
    </div>

    
</x-app-layout>

