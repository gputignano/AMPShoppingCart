<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateAttributeFormRequest extends FormRequest
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
            'label' => 'sometimes|required|unique:attributes,label,' . $this->attribute->id,
            'value' => 'sometimes|required',
            'attribute_sets' => 'sometimes|array',
        ];
    }
}
