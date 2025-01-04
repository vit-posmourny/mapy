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
            $table->tinyText('label');
            $table->tinyText('location');
            $table->tinyText('name');
            $table->decimal('latitude', total: 18, places: 15);
            $table->decimal('longitude', total: 18, places: 15);
            $table->tinyText('regional_address');
            $table->tinyText('regional_street');
            $table->tinyText('regional_municipality_part_1');
            $table->tinyText('regional_municipality_part_2');
            $table->tinyText('regional_municipality');
            $table->tinyText('regional_region_1');
            $table->tinyText('regional_region_2');
            $table->tinyText('regional_country');
            $table->tinyText('isoCode');
            $table->string('zip', 6)->default('n/a');
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
