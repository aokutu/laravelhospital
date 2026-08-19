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
    Schema::table('mpesa_transactions', function (Blueprint $table) {
        $table->string('first_name')->nullable()->after('phone');
        $table->string('middle_name')->nullable()->after('first_name');
        $table->string('last_name')->nullable()->after('middle_name');
        $table->string('bill_ref')->nullable()->after('last_name'); // optional but useful
    });
}

public function down(): void
{
    Schema::table('mpesa_transactions', function (Blueprint $table) {
        $table->dropColumn(['first_name', 'middle_name', 'last_name', 'bill_ref']);
    });
}
};
