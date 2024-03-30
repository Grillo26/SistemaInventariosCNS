<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('dll') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ __('Editar Dll') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pasillos</a></div>
            <div class="breadcrumb-item"><a href="{{ route('dll') }}">Editar Dll</a></div>
        </div>
    </x-slot>

    <div>
        @role('Admin')
        <livewire:create-dll action="updateDll" :dllId="request()->dllId" />
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>
</x-app-layout>
