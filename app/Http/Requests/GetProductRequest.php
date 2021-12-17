<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\ProductContract;
use Illuminate\Support\Facades\Auth;

class GetProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return  true;     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
                ProductContract::SUBCATEGORY_ID => [
                ],
                ProductContract::TITLE => [
                ],
                ProductContract::IMAGE => [
                ],
                ProductContract::DESCRIPTION => [
                ],
                ProductContract::PRICE => [
                ],
        ];
    }
}
