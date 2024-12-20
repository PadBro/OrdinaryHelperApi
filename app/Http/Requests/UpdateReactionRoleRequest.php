<?php

namespace App\Http\Requests;

use App\Rules\DiscordMessageRule;
use App\Rules\EmojiRule;
use App\Rules\RoleRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReactionRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message_link' => ['required', 'string', new DiscordMessageRule],
            'emoji' => ['required', 'string', new EmojiRule],
            'role_id' => ['required', 'string', new RoleRule],
        ];
    }
}
