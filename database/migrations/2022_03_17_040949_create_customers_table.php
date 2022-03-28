<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_rek', 20);
            $table->string('no_akd', 60);
            $table->string('nama_singkat');
            $table->date('tgl_jt');
            $table->tinyInteger('jnk_wkt_bl');
            $table->unsignedDecimal('plafond_awal', 22, 2);
            $table->unsignedDecimal('bunga', 22, 2);
            $table->unsignedDecimal('pokok', 22, 2);
            $table->tinyInteger('kolektibility');
            $table->string('prd_name');
            $table->unsignedDecimal('saldo_akhir', 22, 2);
            $table->unsignedDecimal('totagunan_ydp', 22, 2);
            $table->date('tgl_mulai');
            $table->string('aonm');
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
        Schema::dropIfExists('customers');
    }
}
