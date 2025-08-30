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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('url');
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->string('duration'); 
            $table->string('video_id', 32)->nullable();

            $table->unsignedBigInteger('platform_id')->nullable();
            $table->unsignedBigInteger('section_id');

            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('set null');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

            $table->timestamps();

            // Índices útiles
            $table->index(['platform_id', 'section_id']);
            $table->index('video_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};
