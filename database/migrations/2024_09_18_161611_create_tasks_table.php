<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_category_id')->nullable()->references('id')
            ->on('task_categories')
            ->onDelete('cascade');
            $table->string("title", 255)->nullable();
            $table->longText("description")->nullable();
            $table->date('due_date')->nullable(); 
            $table->tinyInteger("priority")->default(1)->comment("0 = low, 1 = medium, 2 = high");
            $table->tinyInteger("status")->default(1)->comment("1 = active, 0 = inactive");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
