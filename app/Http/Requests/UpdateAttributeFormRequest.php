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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_system' => $this->is_system ? true : false,
            'is_visible_on_front' => $this->is_visible_on_front ? true : false,
        ]);
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
            'is_system' => 'boolean',
            'is_visible_on_front' => 'boolean',
            'value' => 'sometimes|required',
        ];
    }
}
