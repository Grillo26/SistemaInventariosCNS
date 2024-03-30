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
    dashboard user normal
    @endrole
</div>
