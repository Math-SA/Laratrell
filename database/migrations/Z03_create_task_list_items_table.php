<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        
        Schema::create('task_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')
                ->references('id')->on('task_lists')
                ->onDelete('cascade')
                ->constrained();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('order');
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
        Schema::dropIfExists('task_list_items');
    }
};
