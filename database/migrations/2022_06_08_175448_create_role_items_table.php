<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('due_date');
            $table->unsignedBigInteger('list_id');
            $table->foreign('list_id')->references('id')->on('role_lists')->onDelete('cascade');
            $table->integer('status')->default('0')->nullable();
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
        Schema::dropIfExists('role_items');
    }
}
