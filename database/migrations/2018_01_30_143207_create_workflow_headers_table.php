<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workflow_header_desc');
            $table->integer('workflow_process_id');
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
        Schema::table('workflow_headers', function (Blueprint $table) {
            Schema::dropIfExists('workflow_headers');
        });
    }
}
