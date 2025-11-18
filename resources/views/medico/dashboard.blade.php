@extends('layouts.app')

@section('title', 'Médico - Dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Dashboard Médico</h1>
  </div>

  <div class="row g-3">
    <div class="col-sm-6 col-md-3">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Citas hoy</h6>
          <p class="display-6 mb-0">—</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Pacientes</h6>
          <p class="display-6 mb-0">—</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Próxima cita</h6>
          <p class="mb-0">—</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Estado</h6>
          <p class="mb-0">—</p>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Resumen</h5>
        <p class="card-text">Vista inicial del dashboard del médico. Aquí se mostrarán estadísticas y accesos rápidos.</p>
      </div>
    </div>
  </div>
</div>

@endsection
