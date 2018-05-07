<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigationlinks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_name', 50)->unique();
            $table->string('text', 10);
            $table->unsignedSmallInteger('priority')->unique();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('navigationlinks');
    }
}
