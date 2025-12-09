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
            if (!Schema::hasColumn('appointments', 'scheduled_at')) {
                $table->dateTime('scheduled_at')->nullable()->after('medico_id');
            }
            if (!Schema::hasColumn('appointments', 'motivo')) {
                $table->text('motivo')->nullable()->after('scheduled_at');
            }
            if (!Schema::hasColumn('appointments', 'status')) {
                $table->string('status')->default('pendiente')->after('motivo');
            }
            // foreign keys not strictly necessary now; can be added if DB engine supports
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('appointments', 'motivo')) {
                $table->dropColumn('motivo');
            }
            if (Schema::hasColumn('appointments', 'scheduled_at')) {
                $table->dropColumn('scheduled_at');
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
