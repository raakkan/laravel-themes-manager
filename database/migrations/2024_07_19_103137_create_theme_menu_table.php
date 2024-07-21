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
        Schema::create(config('themes-manager.menus.database_table_name', 'theme_menus'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create(config('themes-manager.menus.menu_items_database_table_name', 'theme_menu_items'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('name');
            $table->integer('order')->default(1);
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
    
            $table->foreign('menu_id')->references('id')->on(config('themes-manager.menus.database_table_name', 'theme_menus'))->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on(config('themes-manager.menus.menu_items_database_table_name', 'theme_menu_items'))->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('themes-manager.menus.database_table_name', 'theme_menus'));
        Schema::dropIfExists(config('themes-manager.menus.menu_items_database_table_name', 'theme_menu_items'));
    }
};
