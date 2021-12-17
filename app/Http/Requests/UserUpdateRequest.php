<?php

namespace App\Http\Requests;

use App\Domain\Contracts\UserContract;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            UserContract::NAME     => 'string',
            UserContract::EMAIL    => 'email',
            UserContract::PHONE    => 'string',
            UserContract::CITY     => 'string',
            UserContract::LANGUAGE => 'string',
            UserContract::PASSWORD => 'min:6 | regex:/[a-z]/ | regex:/[A-Z]/ | regex:/[0-9]/'
        ];
    }
}
