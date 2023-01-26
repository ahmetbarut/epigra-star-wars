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
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Irkın adı
            $table->string('classification'); // Irkın sınıflandırması
            $table->string('designation'); // Irkın ataması
            $table->string('average_height'); // Irkın ortalama boyu
            $table->string('skin_colors'); // Irkın cilt rengi
            $table->string('hair_colors'); // Irkın saç rengi
            $table->string('eye_colors'); // Irkın göz rengi
            $table->string('average_lifespan'); // Irkın ortalama ömrü
            $table->string('language'); // Irkın dil
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
        Schema::dropIfExists('species');
    }
};
