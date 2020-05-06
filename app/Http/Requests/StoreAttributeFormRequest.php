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
                Rule::in([
                    \App\Models\EAVBoolean::class,
                    \App\Models\EAVDecimal::class,
                    \App\Models\EAVInteger::class,
                    \App\Models\EAVSelect::class,
                    \App\Models\EAVString::class,
                    \App\Models\EAVText::class,
                ]),
            ],
        ];
    }
}
