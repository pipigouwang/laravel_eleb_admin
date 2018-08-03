<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventprizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventprizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->comment('活动ID');
            $table->string('name')->comment('活动名称');
            $table->text('description')->comment('奖品详情');
            $table->integer('user_id')->comment('中奖商家ID');
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
        Schema::dropIfExists('eventprizes');
    }
}
