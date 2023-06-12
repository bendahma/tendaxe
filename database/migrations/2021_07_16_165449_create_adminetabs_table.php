<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminetabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminetabs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_etablissement');
            $table->string('category');
            $table->string('wilaya')->nullable();
            $table->string('commune')->nullable();
            $table->string('fax')->nullable();
            $table->string('fix')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('adminetabs');
    }
}
