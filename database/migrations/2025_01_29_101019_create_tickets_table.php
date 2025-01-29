<?php

use App\Models\TicketButton;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TicketButton::class);
            $table->string('channel_id', 20)->nullable();
            $table->integer('state');
            $table->string('created_by_discord_user_id', 20);
            $table->string('closed_by_discord_user_id', 20)->nullable();
            $table->text('closed_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
