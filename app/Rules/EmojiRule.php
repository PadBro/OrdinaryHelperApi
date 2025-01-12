<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class EmojiRule implements ValidationRule
{
    private string $discordEmojiRegex = '/^<.+:([0-9]+)>$/';

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (\Emoji\is_single_emoji($value) !== false) {
            return;
        }

        if (preg_match($this->discordEmojiRegex, $value, $matches)) {
            dump(1);
            $emojiId = $matches[1];

            $response = Http::discordBot()->get('/guilds/'.config('services.discord.server_id').'/emojis');
            $guildEmojis = $response->json();
            if (! is_array($guildEmojis)) {
                $fail('could not validate :attribute');

                return;
            }

            foreach ($guildEmojis as $guildEmoji) {
                if (isset($guildEmoji['id']) && $guildEmoji['id'] === $emojiId) {
                    return;
                }
            }
        }
        dump(2);

        $fail(':attribute must be a valid emoji');
    }
}
