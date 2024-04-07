<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
            <a href="{{ route('reporte') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
		<h1>{{ __('Artículos Próximos a Vencer') }}</h1>

		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Sistema</a></div>
			<div class="breadcrumb-item"><a href="#">Información</a></div>
			<div class="breadcrumb-item"><a href="{{ route('reporte') }}">Reportes Vencimiento</a></div>
		</div>
	</x-slot>

    <div>
        @role('Admin')
        <livewire:reporte-caducar/>
        @else
        <livewire:unauthorized-message />
        @endrole
    </div>

    
</x-app-layout>
