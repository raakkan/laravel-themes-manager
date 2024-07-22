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
        Schema::create(config('themes-manager.widgets.database_table_name', 'theme_widgets'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('source');
            $table->string('location')->nullable();
            $table->integer('order')->default(1);
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('themes-manager.widgets.database_table_name', 'theme_widgets'));
    }
};
