@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Historial de Citas</h2>

    <div class="card">
        <div class="card-body">
            <p class="card-text text-muted">Aquí puedes ver todas tus citas pasadas y futuras.</p>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Especialidad</th>
                            <th scope="col">Médico</th>
                            <th scope="col">Fecha y Hora</th>
                            <th scope="col">Modalidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- INICIO: Datos de maqueta (simulando la BD) --}}

                        {{-- Ejemplo 1: Cita Completada --}}
                        <tr>
                            <td>Cardiología</td>
                            <td>Dr. Ricardo Morales</td>
                            <td>20/10/2025 09:00 AM</td>
                            <td>Presencial</td>
                            <td>
                                <span class="badge bg-success">Completada</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info">Ver Detalle</a>
                            </td>
                        </tr>

                        {{-- Ejemplo 2: Cita Próxima (Confirmada) --}}
                        <tr>
                            <td>Medicina General</td>
                            <td>Dra. Ana Fuentes</td>
                            <td>25/11/2025 11:30 AM</td>
                            <td>Remota</td>
                            <td>
                                <span class="badge bg-primary">Confirmada</span>
                            </td>
                            <td>
                                {{-- Según el diagrama, la Cita tiene los métodos cancelar() y reprogramar() --}}
                                <a href="#" class="btn btn-sm btn-outline-danger">Cancelar</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Reprogramar</a>
                            </td>
                        </tr>

                        {{-- Ejemplo 3: Cita Cancelada --}}
                        <tr>
                            <td>Dermatología</td>
                            <td>Dr. Juan Torres</td>
                            <td>05/11/2025 04:00 PM</td>
                            <td>Presencial</td>
                            <td>
                                <span class="badge bg-danger">Cancelada</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info">Ver Detalle</a>
                            </td>
                        </tr>

                        {{-- Ejemplo 4: Cita Pendiente --}}
                        <tr>
                            <td>Pediatría</td>
                            <td>Dra. Luisa Peña</td>
                            <td>30/11/2025 10:00 AM</td>
                            <td>Remota</td>
                            <td>
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-danger">Cancelar</a>
                            </td>
                        </tr>

                        {{-- FIN: Datos de maqueta --}}
                    </tbody>
                </table>
            </div>

            <div class_="text-start">
                 <a href="{{ url('/paciente/dashboard') }}" class="btn btn-secondary mt-3">Volver al Dashboard</a>
            </div>

        </div>
    </div>
</div>
@endsection