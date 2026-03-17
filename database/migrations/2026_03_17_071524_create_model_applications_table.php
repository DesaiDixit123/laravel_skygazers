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
        Schema::create('model_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('country');
            $table->integer('age');
            $table->string('gender');
            $table->string('height');
            $table->string('measurements');
            $table->string('affiliate_code')->nullable();
            $table->string('instagram');
            $table->string('telegram');
            $table->string('whatsapp_number');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_applications');
    }
};
