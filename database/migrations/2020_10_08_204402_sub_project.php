<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_project', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('project_id');
            $table->string('side_id');
            $table->string('codec');
            $table->string('aspect_ratio');
            $table->string('fps');
            $table->string('size');
            $table->string('file_path');
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
        Schema::dropIfExists('sub_project');
    }
}
