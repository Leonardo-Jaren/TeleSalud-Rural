@extends('layouts.app')

@section('title', 'Médico - Pacientes')

@section('content')

<div class="container py-4" style="max-width: 1200px;">
  <h1 class="h3 mb-4">Lista de pacientes</h1>

  <div class="card">
    <div class="card-body">
      <p class="text-muted">Listado estático de pacientes asociados al médico (solo vista).</p>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Edad</th>
              <th>Teléfono</th>
              <th>Última visita</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Juan Pérez</td>
              <td>34</td>
              <td>+51 9xx xxx xxx</td>
              <td>2025-11-10</td>
              <td><button class="btn btn-sm btn-outline-primary">Ver</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

@endsection
