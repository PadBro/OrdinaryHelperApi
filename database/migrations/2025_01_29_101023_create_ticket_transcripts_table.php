<?php

use App\Models\Ticket;
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
        Schema::create('ticket_transcripts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ticket::class);
            $table->string('discord_user_id', 20);
            $table->string('message_id', 20)->unique();
            $table->text('message')->nullable();
            $table->json('attachments')->nullable();
            $table->json('embeds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_transcripts');
    }
};
