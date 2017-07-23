<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('delivery_id');
            $table->integer('shipping_cost');

            $table->integer('pet_id');
            $table->integer('pet_weight');
            $table->integer('pet_activity_level');

            $table->integer('package_id');
            $table->string('package_stripe_code');
            $table->integer('package_base');

            $table->integer('weeks_at_a_time');

            $table->boolean('active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
