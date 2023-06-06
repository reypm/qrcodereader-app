<?php

namespace App\Http\Requests;

use App\Models\Enums\SubmissionStatusEnum;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SubmissionUpdateRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['string', 'max:255'],
            'status' => [new Enum(SubmissionStatusEnum::class)],
        ];
    }
}
