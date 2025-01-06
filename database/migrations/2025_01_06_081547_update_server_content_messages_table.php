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
        Schema::table('server_content_messages', function (Blueprint $table) {
            $table->string('heading', 2000)->change();
            $table->string('not_recommended', 2000)->change();
            $table->string('recommended', 2000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('server_content_messages', function (Blueprint $table) {
            $table->string('heading')->change();
            $table->string('not_recommended')->change();
            $table->string('recommended')->change();
        });
    }
};
