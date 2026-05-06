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
        Schema::table('rooms', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false)->after('description');
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false)->after('address');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false)->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });
    }
};
