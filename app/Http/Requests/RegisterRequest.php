<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Domain\Contracts\UserContract;
class RegisterRequest extends FormRequest
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
            UserContract::NAME          => ['required', 'string', 'max:255'],
            UserContract::PHONE         => ['required', 'max:15', 'unique:users'],
            UserContract::PASSWORD      => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
            UserContract::SUBSCRIPTION  => ['required', 'boolean'],
            UserContract::EMAIL         => ['nullable', 'email', 'unique:users', Rule::requiredIf((bool) $this->input(UserContract::SUBSCRIPTION ) === true)]
        ];
    }
}
