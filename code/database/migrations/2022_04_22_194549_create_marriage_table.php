<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarriageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marriage', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('person1') ->nullable()->default(null);
            $table->unsignedInteger('person2') ->nullable()->default(null);
            $table->unsignedSmallInteger('married_year')  ->nullable()->default(null);
            $table->unsignedTinyInteger('married_month')  ->nullable()->default(null);
            $table->unsignedTinyInteger('married_day') ->nullable()->default(null);
            $table->timestamps();

            $table->unique(['person1', 'person2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marriage');
    }
}
