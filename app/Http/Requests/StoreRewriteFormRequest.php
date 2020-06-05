<?php

namespace App\Http\Requests;

class StoreRewriteFormRequest extends FormRequest
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
            'is_active' => $this->is_active ? true : false,
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
            'slug' => 'required|unique:rewrites',
            'meta_title' => 'required_with:slug',
            'meta_description' => 'required_with:slug',
            'meta_robots' => 'present',
            'entity_type' => 'required',
            'entity_id' => 'required',
            'is_active' => 'present',
        ];
    }
}
