@php
$user = auth()->user();
@endphp
<x-slot name="header_content">
    <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Bienvenida</a></div>
          
        </div>
    </x-slot>
<div>
    @role('Admin')
    <x-jet-welcome />
    @else

    <div class="col-12 mb-4">
      <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('{{ asset('img/almacen.png') }}');">
        <div class="hero-inner">
          <h2>Bienvenido, {{ $user->name }}</h2>
              <p class="lead">Este sistema esta creado a medida para la Caja Nacional de Salud distrital Yacuiba. Cualquier consulta o duda recurra 
                  al manual del usuario o contáctese con el desarrollador.
              </p>
        </div>
      </div>
    </div>

    @endrole
</div>
