<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_name')->after('user_id');
            $table->string('shipping_address')->after('shipping_name');
            $table->string('shipping_postal_code', 10)->after('shipping_address');
            $table->string('shipping_city')->after('shipping_postal_code');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_name', 'shipping_address', 'shipping_postal_code', 'shipping_city']);
        });
    }
};
