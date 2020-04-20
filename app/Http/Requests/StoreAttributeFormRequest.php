<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreAttributeFormRequest extends FormRequest
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
            'label' => 'required|unique:attributes',
            'type' => [
                'required',
                Rule::in(['App\Models\EAVBoolean', 'App\Models\EAVDecimal', 'App\Models\EAVInteger', 'App\Models\EAVString', 'App\Models\EAVText']),
            ],
        ];
    }
}
