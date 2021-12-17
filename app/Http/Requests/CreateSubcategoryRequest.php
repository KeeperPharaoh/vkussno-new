<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\SubcategoryContract;
use Illuminate\Support\Facades\Auth;

class CreateSubcategoryRequest extends FormRequest
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
                SubcategoryContract::TITLE => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
                SubcategoryContract::CATEGORY_ID => [
                    'integer' =>
                            'true',
                            ],
        ];
    }
}
