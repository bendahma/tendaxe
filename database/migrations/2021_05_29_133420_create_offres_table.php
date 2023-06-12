<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('titre');
            $table->string('img_offre')->nullable();
            $table->string('img_offre2')->nullable();
            $table->text('description')->nullable();
            $table->date('date_pub');
            $table->date('date_limit');
            $table->string('statut');
            $table->string('type');
            $table->integer('prix')->nullable();
            $table->string('wilaya')->nullable();
            // $table->string('journal_ar')->nullable();
            // $table->string('journal_fr')->nullable();
            $table->string('etat')->default('pending');
           
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
        Schema::dropIfExists('offres');
    }
}
