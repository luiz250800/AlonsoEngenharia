<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cliente', function (Blueprint $table) {
            $table->bigIncrements('cd_cliente');
            $table->unsignedBigInteger('cd_usuario');
            $table->foreign('cd_usuario')->references('cd_usuario')->on('tb_usuario');
            $table->string('nm_razao_social_cliente', 50);
            $table->string('nm_fantasia_cliente', 60);
            $table->string('cd_cnpj_cliente', 15);
            $table->string('nm_endereco_cliente', 80);
            $table->string('nm_email_cliente', 50);
            $table->string('cd_telefone_cliente', 10);
            $table->string('nm_responsavel_cliente', 50);
            $table->string('cd_cpf_responsavel_cliente', 11);
            $table->string('cd_celular_responsavel_cliente', 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cliente');
    }
}
