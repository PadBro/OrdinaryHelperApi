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
        Schema::create('server_contents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('url', 256);
            $table->string('description', 512);
            $table->boolean('is_recommended');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_content');
    }
};
