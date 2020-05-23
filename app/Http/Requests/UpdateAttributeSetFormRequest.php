<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateAttributeSetFormRequest extends FormRequest
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
            'label' => 'sometimes|unique:attribute_sets,label,' . $this->attributeSet->id,
            'attributes' => 'sometimes|array',
        ];
    }
}
