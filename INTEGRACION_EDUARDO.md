# Guía de Integración - Integrante 4 (Eduardo)

## 📋 Resumen de Entregables

He preparado la **lógica de búsqueda y experiencia del paciente** para que funcione cuando los otros integrantes entreguen sus componentes.

---

## 1. Backend - PacienteController

**Ubicación:** `app/Http/Controllers/PacienteController.php`

### Métodos implementados:

- **`dashboard()`** → Muestra próxima cita (cuando Johan entregue Appointment)
- **`reservarCita()`** → Muestra formulario de reserva
- **`historial()`** → Lista citas del paciente (cuando Johan entregue Appointment)
- **`perfilMedico()`** → Lista médicos con especialidades (cuando Leonardo entregue Doctor/Specialty)
- **`searchDoctors($request)`** → Busca médicos por especialidad (filtro GET)
- **`getDoctorsBySpecialty($specialtyId)`** → Retorna médicos en JSON (para AJAX)

### Dependencias externas:
- Modelos: `User`, `Doctor`, `Specialty`, `Appointment` (de otros integrantes)
- Relaciones: `User->doctor->specialties`, `User->appointmentsAsPatient()`

---

## 2. Frontend - Vistas Dinámicas

### `resources/views/paciente/dashboard.blade.php`
- Usa `@if(isset($proximaCita))` para mostrar la próxima cita
- Cuando Johan integre AppointmentController, el dashboard pasará `$proximaCita`

### `resources/views/paciente/perfil-medico.blade.php`
- Usa `@forelse($medicos ?? [] as $medico)` para iterar médicos reales
- Si no hay datos, muestra maqueta de demostración
- Incluye **barra de búsqueda por especialidad**
- Campos dinámicos: `$medico->name`, `$medico->doctor->bio`, `$medico->doctor->cmp_code`, `$medico->doctor->specialties`

---

## 3. Notificaciones - Mailable

**Ubicación:** `app/Mail/AppointmentConfirmation.php`

### Cómo usarlo (instrucciones para Johan):

Cuando Johan cree el AppointmentController, en el método `store()` (después de crear la cita):

```php
use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\Mail;

// En AppointmentController->store()
$appointment = Appointment::create([...]);
$patient = $appointment->patient()->first(); // User
$doctor = $appointment->doctor()->first();   // User

// Enviar correo (log driver por defecto)
Mail::to($patient->email)->send(
    new AppointmentConfirmation($appointment, $patient, $doctor)
);
```

**Plantilla:** `resources/views/emails/appointment-confirmation.blade.php`
- Muestra detalles de la cita
- Incluye link de telemedicina si aplica

---

## 4. Rutas Agregadas

En `routes/web.php`:

```php
// Rutas de búsqueda de médicos (Integrante 4 - Eduardo)
Route::get('/paciente/medicos/search', [PacienteController::class, 'searchDoctors'])->name('paciente.search-doctors');
Route::get('/paciente/medicos/by-specialty/{specialtyId}', [PacienteController::class, 'getDoctorsBySpecialty'])->name('paciente.doctors-by-specialty');
```

---

## 5. Flujo de Integración Recomendado

### Paso 1: Leonardo entrega modelos y migraciones
- Necesario para que funcione: `Doctor`, `Specialty`, relaciones en `User`

### Paso 2: Johan entrega AppointmentController
- Debe integrar el Mailable `AppointmentConfirmation` en `store()`
- Debe pasar `$proximaCita` al dashboard del paciente

### Paso 3: William entrega DoctorController
- Necesario para que funcionen horarios y perfil médico

### Paso 4: Yo (Eduardo) actualizo las vistas
- Una vez que todos entreguen, descomento el código en PacienteController
- Las vistas ya están preparadas para recibir los datos

---

## 6. Datos de Prueba (Mock)

Mientras se esperan los modelos de otros integrantes:
- `perfil-medico.blade.php` muestra **3 médicos de demostración**
- `dashboard.blade.php` muestra **alerta si no hay próxima cita**

---

## 7. Pendiente de Otros Integrantes

Para que TODO funcione dinámicamente:

- **Leonardo:** Migraciones `users` (agregar `role`), `doctors`, `patients`, `specialties`, `doctor_specialty`
- **William:** Migración `schedules`, controlador `DoctorController` con `updateProfile()` y `storeSchedule()`
- **Johan:** Migración `appointments`, controlador `AppointmentController` con `store()` que dispare el Mailable
- **Admin:** Seeder para especialidades y usuario admin

---

## 📞 Notas de Integración

1. Los comentarios en `PacienteController.php` indican dónde descomenta el código cuando esté listo
2. Todas las vistas usan `@forelse` para no romper si los datos están vacíos
3. El Mailable usa `log` driver por defecto (revisa `config/mail.php`)
4. Las rutas con nombre facilitan referencias desde otras vistas

---

**Rama:** `eduardo`  
**Fecha de entrega:** 3 de diciembre de 2025
