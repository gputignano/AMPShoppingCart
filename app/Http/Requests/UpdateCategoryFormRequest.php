<?php

namespace App\Http\Requests;

class UpdateCategoryFormRequest extends FormRequest
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
            'name' => 'sometimes|required',
            'description' => 'sometimes',
            'parent_id' => 'sometimes',

            'meta' => 'sometimes|array',
            'meta.meta_title' => 'required_with:meta',
            'meta.meta_description' => 'required_with:meta',
        ];
    }
}
