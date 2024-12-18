<?php

// database/migrations/2024_12_17_create_vouchers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->integer('durasi');
            $table->string('paket_voucher');
            $table->string('logo');
            $table->string('profile'); // menyimpan profil dari session
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
