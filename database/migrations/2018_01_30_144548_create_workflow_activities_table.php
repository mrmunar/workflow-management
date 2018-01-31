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
        Schema::create('workflow_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id');
            $table->string('processor');
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
        Schema::table('workflow_activities', function (Blueprint $table) {
            Schema::dropIfExists('workflow_activities');
        });
    }
}
