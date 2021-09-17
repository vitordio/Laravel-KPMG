<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cad_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('des_nome');
            $table->string('des_cpf', 11);
            $table->string('des_email');
            $table->string('des_telefone', 11)->nullable(true);
            $table->string('des_path_image')->nullable(true);

            $table->string('password');
            $table->char('flg_ativo', 1);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes('deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cad_usuarios');
    }
}
