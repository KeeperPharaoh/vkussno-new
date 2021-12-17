<?php

namespace App\Http\Requests;

use App\Domain\Contracts\UserContract;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            UserContract::PHONE         => ['required', 'max:15', 'exists:users'],
            UserContract::PASSWORD      => ['required'],
        ];
    }
}
