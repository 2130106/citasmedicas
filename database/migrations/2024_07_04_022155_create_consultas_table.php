<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->integer('cita_id')->unique(); // Asegúrate de que 'cita_id' sea único
            $table->string('alergias')->default('no');
            $table->text('alergias_texto')->nullable();
            $table->string('enfermedades')->default('no');
            $table->text('enfermedades_texto')->nullable();
            $table->float('estatura')->nullable();
            $table->float('peso')->nullable();
            $table->float('temperatura')->nullable();
            $table->string('motivo_consulta')->nullable();
            $table->text('notas')->nullable();
            $table->decimal('total', 8, 2)->default(0);

            $table->timestamps();
        });

        Schema::create('consulta_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->unsignedBigInteger('servicio_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consulta_servicio');
        Schema::dropIfExists('consultas');
    }
};
