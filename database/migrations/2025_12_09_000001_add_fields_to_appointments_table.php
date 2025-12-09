<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'paciente_id')) {
                $table->unsignedBigInteger('paciente_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('appointments', 'medico_id')) {
                $table->unsignedBigInteger('medico_id')->nullable()->after('paciente_id');
            }
            if (!Schema::hasColumn('appointments', 'fecha')) {
                $table->date('fecha')->nullable()->after('medico_id');
            }
            if (!Schema::hasColumn('appointments', 'hora')) {
                $table->time('hora')->nullable()->after('fecha');
            }
            if (!Schema::hasColumn('appointments', 'estado')) {
                $table->string('estado')->default('pendiente')->after('hora');
            }
            if (!Schema::hasColumn('appointments', 'motivo')) {
                $table->text('motivo')->nullable()->after('estado');
            }
            if (!Schema::hasColumn('appointments', 'especialidad_id')) {
                $table->unsignedBigInteger('especialidad_id')->nullable()->after('motivo');
            }

            // Opcional: llaves foráneas (comentadas por compatibilidad)
            // $table->foreign('paciente_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('medico_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'especialidad_id')) {
                $table->dropColumn('especialidad_id');
            }
            if (Schema::hasColumn('appointments', 'motivo')) {
                $table->dropColumn('motivo');
            }
            if (Schema::hasColumn('appointments', 'estado')) {
                $table->dropColumn('estado');
            }
            if (Schema::hasColumn('appointments', 'hora')) {
                $table->dropColumn('hora');
            }
            if (Schema::hasColumn('appointments', 'fecha')) {
                $table->dropColumn('fecha');
            }
            if (Schema::hasColumn('appointments', 'medico_id')) {
                $table->dropColumn('medico_id');
            }
            if (Schema::hasColumn('appointments', 'paciente_id')) {
                $table->dropColumn('paciente_id');
            }
        });
    }
};
