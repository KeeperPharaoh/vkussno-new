<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AcceptCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'payment_type'  => 'required',
            'delivery_time' => 'required',
            'promo_code'    => '',
            'address'       => 'required',
            'comment'       => '',
            'bonus'         => 'required',
            'data'          => 'array',
            '.*.id'         => 'required|integer|exists:products',
            '.*.quantity'   => 'required|integer',
            '.*.price'      => 'integer'
        ];
    }
}
