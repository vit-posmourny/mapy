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
        Schema::create('elevations', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', total: 18, places: 15);
            $table->decimal('longitude', total: 18, places: 15);
            $table->float('elevation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elevations');
    }
};
