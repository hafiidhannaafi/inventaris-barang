<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pinjams_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('users_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('trx_status');
    }
}
