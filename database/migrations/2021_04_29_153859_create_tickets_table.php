<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            //  $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('priority_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('project')->nullable();
            $table->text('description')->nullable();
            $table->date('date_expired')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
