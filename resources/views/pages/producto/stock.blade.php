<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Verificar Stock') }}</h1>
        
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Artículo</a></div>
            <div class="breadcrumb-item"><a href="{{ route('stock') }}">Stock</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:stock action="buscarStock" />
    </div>
</x-app-layout>