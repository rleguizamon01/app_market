<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientApp', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->integer('user_id');
            $table->integer('app_id')->foreign('app_id')->references('app_id')->on('apps')->onDelete('cascade');
            $table->boolean('has_bought');
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
        Schema::dropIfExists('clientApp');
    }
}
