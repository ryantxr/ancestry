<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('first', 100 ) ->nullable()->default(null);
            $table->string('middle_names', 100)  ->nullable()->default(null);
            $table->string('last', 100) ->nullable()->default(null);
            $table->string('suffix', 10)  ->nullable()->default(null);
            $table->string('alt_last', 100)  ->nullable()->default(null);
            $table->string('nickname', 20) ->nullable()->default(null);
            $table->string('title', 10)  ->nullable()->default(null);
            $table->boolean('born_circa')->default(false);
            $table->smallinteger('born_year')  ->nullable()->default(null);
            $table->smallinteger('born_month')  ->nullable()->default(null);
            $table->smallinteger('born_day')  ->nullable()->default(null);
            $table->string('born_where', 100) ->nullable()->default(null);
            $table->smallinteger('died_year')  ->nullable()->default(null);
            $table->smallinteger('died_month')  ->nullable()->default(null);
            $table->smallinteger('died_day')  ->nullable()->default(null);
            $table->string('died_where', 100) ->nullable()->default(null);
            $table->string('buried_where', 100)  ->nullable()->default(null);
            $table->char('gender', 1) ->nullable()->default(null);
            $table->unsignedInteger('father_id')   ->nullable()->default(null);
            $table->unsignedInteger('mother_id')   ->nullable()->default(null);
            $table->text('notes') ->nullable();
            $table->timestamps();
            
        });
        DB::statement('ALTER TABLE `person` ADD FULLTEXT x_full_person(`first`,`middle_names`,`last`,`alt_last`,`nickname`,`born_where`,`died_where`,`buried_where`,`notes`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}
