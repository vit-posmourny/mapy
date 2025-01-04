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
        Schema::create('rgeocodes', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');
            $table->id();
            $table->string('label')->default('');
            $table->string('location')->default('');
            $table->string('name')->default('');
            $table->decimal('latitude', total: 18, places: 15)->nullable();
            $table->decimal('longitude', total: 18, places: 15)->nullable();
            $table->string('regional_address')->default('');
            $table->string('regional_street')->default('');
            $table->string('regional_municipality_part_1')->default('');
            $table->string('regional_municipality_part_2')->default('');
            $table->string('regional_municipality')->default('');
            $table->string('regional_region_1')->default('');
            $table->string('regional_region_2')->default('');
            $table->string('regional_country')->default('');
            $table->string('isoCode')->default('');
            $table->string('zip', 6)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rgeocodes');
    }
};
