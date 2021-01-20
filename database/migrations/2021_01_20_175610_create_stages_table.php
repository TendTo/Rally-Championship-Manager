<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->foreignId('rally_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to Championships table
            $table->text('desc')->nullable();

            $table->index(['name', 'rally_id']); //Unique combination name-rally
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stages');
    }
}
