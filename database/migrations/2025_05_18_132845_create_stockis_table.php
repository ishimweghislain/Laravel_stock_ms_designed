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
        Schema::create('stockis', function (Blueprint $table) {
            $table->id('stockiid');
            $table->foreignId('productid')->constrained('products','productid')->onDelete('cascade');
            $table->date('stockidate');
            $table->integer('quantity');
            $table->decimal('unitprice', 10, 2);
            $table->decimal('totalprice', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockis');
    }
};
