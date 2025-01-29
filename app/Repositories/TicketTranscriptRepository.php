<?php

namespace App\Repositories;

use App\Models\TicketTranscript;

class TicketTranscriptRepository
{
    public function __construct(
        protected DiscordRepository $discordRepository,
    ) {}

    /**
     * @return array{
     *     id: string,
     *     username: string,
     *     avatar: string,
     *     discriminator: string,
     *     public_flags: string,
     *     flags: string,
     *     banner: string|null,
     *     accent_color: number,
     *     global_name: string,
     *     avatar_decoration_data?: string,
     *     banner_color: string,
     *     clan?: string,
     *     primary_guild?: string,
     * }
     */
    public function getUser(TicketTranscript $ticketTranscript): array
    {
        /**
         * @var array{
         *     id: string,
         *     username: string,
         *     avatar: string,
         *     discriminator: string,
         *     public_flags: string,
         *     flags: string,
         *     banner: string|null,
         *     accent_color: number,
         *     global_name: string,
         *     avatar_decoration_data?: string,
         *     banner_color: string,
         *     clan?: string,
         *     primary_guild?: string,
         * }
         */
        return $this->discordRepository->getUserById($ticketTranscript->discord_user_id);
    }
}
