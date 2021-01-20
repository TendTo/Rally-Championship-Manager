<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('championship_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to Championships table
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to Users table
            $table->foreignId('car_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //foreing key to Car table
            $table->boolean('is_admin')->default(false);

            $table->index(['user_id', 'championship_id']); //Unique combination user-championship
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
