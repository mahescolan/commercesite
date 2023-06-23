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
        Schema::create('orders', function (Blueprint $table){
            $table->id();
            $table->string('order_code');
            $table->unsignedBigInteger('admin_id');
            $table->string('address');
            $table->integer('price');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admin')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
