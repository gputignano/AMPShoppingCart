<?php

namespace App\Http\Requests;

class StoreEavBooleanFormController extends FormRequest
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
            'value' => 'boolean|unique:eav_booleans',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => null != $this->value ? 1 : 0,
        ]);
    }
}
