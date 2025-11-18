@extends('layouts.app')

@section('title', 'Médico - Horarios')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <h1 class="h3 mb-3">Gestión de horarios</h1>

  <div class="card">
    <div class="card-body">
      <p class="text-muted">Vista estática para gestionar franjas horarias. No incluye lógica ni formularios funcionales.</p>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Dia</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Activo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Lunes</td>
            <td>08:00</td>
            <td>12:00</td>
            <td>Sí</td>
            <td><button class="btn btn-sm btn-outline-secondary">Editar</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
