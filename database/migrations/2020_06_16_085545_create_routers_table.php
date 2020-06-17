<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('sapid', 18);
            $table->char('hostname', 14);
            $table->ipAddress('loopback');
            $table->unsignedBigInteger('mac_address');
            $table->enum('type', ['AG1', 'CSS']);
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
        Schema::table('routers', function (Blueprint $table) {
            Schema::drop('routers');
        });
    }
}
