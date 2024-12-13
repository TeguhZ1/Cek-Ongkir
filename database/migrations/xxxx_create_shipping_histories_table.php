<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipping_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('origin_city');
            $table->string('destination_city');
            $table->integer('weight');
            $table->string('courier');
            $table->string('service');
            $table->integer('cost');
            $table->string('etd');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_histories');
    }
};
