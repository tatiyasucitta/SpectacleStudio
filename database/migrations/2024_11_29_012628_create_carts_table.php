<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('carts')) {
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->string('invoice_id')->nullable();
                $table->unsignedBigInteger('quantity');
                $table->unsignedbiginteger('product_id')->nullable();
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');                
                $table->unsignedbiginteger('faktur_id')->nullable();
                $table->foreign('faktur_id')
                    ->references('id')
                    ->on('fakturs')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                    $table->timestamps();
                });
        }
    }
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
