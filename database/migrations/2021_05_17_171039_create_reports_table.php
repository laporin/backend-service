<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('serial'); # $faker->lexify('id-????');
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->text('detail');
            $table->text('address');
            $table->string('city');
            $table->string('subdistrict');
            $table->double('latitude');
            $table->double('longitude');
            $table->boolean('private')->default(false);
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
        Schema::dropIfExists('reports');
    }
}
