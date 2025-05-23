<?php

use App\Models\Course;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->enum('status', [
                Course::BORRADOR,
                Course::REVISION,
                Course::PUBLICADO
            ])->default(Course::BORRADOR);
            $table->string('slug')->unique();
            // $table->string('image')->nullable();
            $table->string('promo_video')->nullable();

            $table->string('hotmart_url')->nullable();
            $table->string('hotmart_id')->nullable();
            $table->string('hotmart_link')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('price_id')->nullable();

            $table->decimal('average_rating', 3, 2)->nullable()->default(0)->comment('Promedio de calificaciones del curso');
            $table->unsignedBigInteger('students_count')->default(0)->comment('Cantidad de estudiantes inscritos');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('set null');

            $table->timestamps();

            // Índices adicionales para optimización
            $table->index('status');
            $table->index('average_rating');
            $table->index('students_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
