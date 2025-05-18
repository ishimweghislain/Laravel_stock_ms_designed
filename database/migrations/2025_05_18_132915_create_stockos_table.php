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
        Schema::create('stockos', function (Blueprint $table) {
            $table->id('stockoid');
            $table->foreignId('productid')->constrained('products','productid')->onDelete('cascade');
            $table->date('stockodate');
            $table->integer('quantity');
            $table->decimal('unitprice', 10, 2);
            $table->decimal('totalprice', 10, 2);
            $table->string('customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockos');
    }
};

