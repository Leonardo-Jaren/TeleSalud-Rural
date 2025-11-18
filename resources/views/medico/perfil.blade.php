@extends('layouts.app')

@section('title', 'Médico - Perfil')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Perfil del Médico</h1>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="mb-3">
            <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Avatar" class="rounded-circle img-fluid" style="width:120px;height:120px;object-fit:cover;">
          </div>
          <h5 class="card-title">Dr. Nombre Apellido</h5>
          <p class="text-muted mb-0">Especialidad</p>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Información</h5>
          <dl class="row">
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">medico@example.com</dd>

            <dt class="col-sm-3">Teléfono</dt>
            <dd class="col-sm-9">+51 9xx xxx xxx</dd>

            <dt class="col-sm-3">Dirección</dt>
            <dd class="col-sm-9">Ciudad, País</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
