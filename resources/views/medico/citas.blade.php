@extends('layouts.app')

@section('title', 'Médico - Citas del día')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <h1 class="h3 mb-3">Citas del día</h1>

  <div class="card">
    <div class="card-body">
      <p class="text-muted">Listado estático de citas programadas para hoy.</p>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Hora</th>
              <th>Paciente</th>
              <th>Motivo</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>09:30</td>
              <td>María López</td>
              <td>Consulta general</td>
              <td><span class="badge bg-success">Confirmada</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
