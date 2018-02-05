<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_process_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('process_id');
            $table->integer('activity_id');
            $table->integer('processor');
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
        Schema::table('workflow_process_activities', function (Blueprint $table) {
            Schema::dropIfExists('workflow_process_activities');
        });
    }
}
