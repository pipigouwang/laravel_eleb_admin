<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('signup_start')->comment('报名开始时间');
            $table->integer('signup_end')->comment('结束时间');
            $table->integer('prize_date')->comment('开奖日期');
            $table->integer('signup_num')->comment('人数限制');
            $table->integer('is_prize')->comment('是否开奖');
            $table->engine=('InnoDb');
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
        Schema::dropIfExists('events');
    }
}
