<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_proposta', function (Blueprint $table) {
            $table->bigIncrements('cd_proposta');
            $table->unsignedBigInteger('cd_cliente');
            $table->foreign('cd_cliente')->references('cd_cliente')->on('tb_cliente');
            $table->string('nm_endereco_obra', 80);
            $table->double('vl_total', 6,2);
            $table->double('vl_sinal', 5,2);
            $table->tinyInteger('qt_parcela');
            $table->double('vl_parcela', 6, 2);
            $table->date('dt_inicio_pagamento');
            $table->date('dt_parcela');
            $table->string('nm_arquivo_proposta')->nullable();
            $table->string('nm_caminho_arquivo_proposta')->nullable();
            $table->char('tp_status_proposta', 1);
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
        Schema::dropIfExists('tb_proposta');
    }
}
