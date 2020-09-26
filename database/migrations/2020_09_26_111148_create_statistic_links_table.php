<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('links_id')
                ->references('id')->on('links')
                ->onDelete('cascade');
            $table->string('ip', 255);
            $table->string('region', 255);
            $table->string('browser', 255);
            $table->string('os', 255);
            $table->dateTime('created_at', 0);
            $table->dateTime('updated_at', 0);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_links');
    }
}
