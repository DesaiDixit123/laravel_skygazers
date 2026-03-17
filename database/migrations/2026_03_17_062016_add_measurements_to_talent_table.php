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
        Schema::table('talent', function (Blueprint $table) {
            $table->string('height')->nullable()->after('label');
            $table->string('bust')->nullable()->after('height');
            $table->string('waist')->nullable()->after('bust');
            $table->string('hips')->nullable()->after('waist');
            $table->string('shoe_size')->nullable()->after('hips');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talent', function (Blueprint $table) {
            $table->dropColumn(['height', 'bust', 'waist', 'hips', 'shoe_size']);
        });
    }
};
