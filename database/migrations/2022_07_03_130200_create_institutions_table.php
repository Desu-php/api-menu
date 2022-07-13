<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->string('slug')->unique();
            $table->json('name');
            $table->string('design')->default('#fd6f3f');
            $table->string('color')->default('#ffffff');
            $table->foreignId('currency_id')->nullable()->constrained();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('background_image')->nullable();
            $table->string('wifi_password')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('institutions');
    }
};
