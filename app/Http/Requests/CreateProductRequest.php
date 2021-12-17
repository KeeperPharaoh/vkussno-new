<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\ProductContract;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return  Auth::check();     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
                ProductContract::SUBCATEGORY_ID => [
                    'integer' =>
                            'true',
                            ],
                ProductContract::TITLE => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
                ProductContract::IMAGE => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
                ProductContract::DESCRIPTION => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
                ProductContract::PRICE => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
        ];
    }
}
