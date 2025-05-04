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
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id')->comment('Expense ID');
            $table->integer('user_id')->unsigned()->comment('User ID');
            $table->decimal('amount', 8, 2);
            $table->string('category')->comment('Category');
            $table->date('date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('userexes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
