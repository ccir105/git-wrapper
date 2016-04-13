<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGitLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('git_logs',function(Blueprint $table){
            $table->increments('id');
            $table->text('log');
            $table->timestamps();
        });
    }
}
