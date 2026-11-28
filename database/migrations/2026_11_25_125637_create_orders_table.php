<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('shipping_service_id')->nullable()->index();
            $table->string('recipient_name')->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('shipping_courier')->nullable();
            $table->string('shipping_service')->nullable();
            $table->string('shipping_eta')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamp('ordered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};