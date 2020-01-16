<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreBaseRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('base_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
