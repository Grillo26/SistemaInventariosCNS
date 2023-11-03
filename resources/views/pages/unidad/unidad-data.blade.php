<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Gestionar Unidades') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}"></a>Sistema</div>
            <div class="breadcrumb-item"><a href="#">Información</a></div>
            <div class="breadcrumb-item"><a href="{{ route('unidades') }}">Gestionar Unidades</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="unidad" :model="$unidad" />
    </div>
</x-app-layout>
