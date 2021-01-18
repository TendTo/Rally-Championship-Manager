<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRalliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'rallies', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('name');
                $table->foreignId('championship_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to Championships table
                $table->foreignId('location_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to Locations table
                $table->text('desc')->nullable();

                $table->index(['name', 'championship_id']); //Unique combination name-championship
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rallies');
    }
}
