<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('entradas') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
		<h1>{{ __('Generar Reporte de Entradas') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Reporte</a></div>
			<div class="breadcrumb-item"><a href="{{ route('reporte') }}">Entradas</a></div>
		</div>
	</x-slot>

    <div>
        @role('Admin')
        <livewire:reporte-entradas/>
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>

    
</x-app-layout>
