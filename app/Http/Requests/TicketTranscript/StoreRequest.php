<?php

namespace App\Http\Requests\TicketTranscript;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->can('ticketTranscript.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ticket_id' => 'required|int|exists:tickets,id',
            'discord_user_id' => 'required|string|max:20',
            'message_id' => 'required|string|max:20',
            'message' => 'nullable|string',
            'attachments' => 'nullable|json',
            'embeds' => 'nullable|json',
        ];
    }
}
