@extends('layouts.app')

@section('title', 'Admin - Usuarios')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <h1 class="h3 mb-3">Usuarios</h1>

  <div class="card">
    <div class="card-body">
      <p class="text-muted">Listado estático de usuarios. Sin lógica de BD.</p>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Administrador</td>
              <td>admin@example.com</td>
              <td>admin</td>
              <td><button class="btn btn-sm btn-outline-secondary">Ver</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
