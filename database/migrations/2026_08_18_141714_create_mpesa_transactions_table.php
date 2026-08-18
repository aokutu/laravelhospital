<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 💡 This conditional check shields your database execution pipeline from crashing
        if (!Schema::hasTable('mpesa_transactions')) {
            Schema::create('mpesa_transactions', function (Blueprint $table) {
                $table->id();
                $table->string('mpesa_code')->unique();
                $table->decimal('amount', 10, 2);
                $table->string('phone');
                $table->string('first_name')->nullable();
                $table->string('middle_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('bill_ref')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('mpesa_transactions');
    }
};
