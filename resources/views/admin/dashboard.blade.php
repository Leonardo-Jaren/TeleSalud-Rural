@extends('layouts.app')

<<<<<<< HEAD
@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Bienvenido al panel de administración (vista mock).</p>
</div>
=======
@section('title', 'Admin - Dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Dashboard - Administración</h1>
  </div>

  <div class="row g-3">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Usuarios</h5>
          <p class="card-text text-muted">Gestión básica y accesos rápidos.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Sistema</h5>
          <p class="card-text text-muted">Resumen de estado del sistema.</p>
        </div>
      </div>
    </div>
  </div>
</div>

>>>>>>> 8116cb95ac1039348e32b4bfcd14c80aebb57760
@endsection
