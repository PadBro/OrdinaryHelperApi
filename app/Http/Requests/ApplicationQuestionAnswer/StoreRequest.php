<?php

namespace App\Http\Requests\ApplicationQuestionAnswer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->can('applicationQuestionAnswer.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'application_question_id' => 'required|exists:application_questions,id',
            'application_id' => 'required|exists:applications,id',
            'answer' => 'required|string',
        ];
    }
}
