<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->id('spot_id');
            $table->string('spot_name');
            $table->string('spot_division_id');
            $table->string('spot_district_id');
            $table->string('spot_types_of_attraction_id');
            $table->text('spot_details');
            $table->text('spot_types_of_vehicles');
            $table->string('spot_photo')->nullable();
            $table->string('spot_entry_fee')->nullable();
            $table->string('spot_opening_time')->nullable();
            $table->string('spot_closing_time')->nullable();
            $table->text('spot_map')->nullable();
            $table->integer('spot_number_of_total_ratings')->default(0);
            $table->double('spot_comfortable_total_rating_point')->default(0);
            $table->double('spot_safe_total_rating_point')->default(0);
            $table->string('spot_slug');
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
        Schema::dropIfExists('spots');
    }
}
