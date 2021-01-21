<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'results', function (Blueprint $table) {
                $table->id();
                $table->timestamps();

                $table->foreignId('participant_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to participant table
                $table->foreignId('stage_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to stage table
                $table->time('time', 3)->nullable();
                $table->time('penality', 3)->nullable();

                $table->index(['participant_id', 'stage_id']); //Unique combination name-rally
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
        Schema::dropIfExists('results');
    }
}
