<?php

namespace App\Http\Requests;

class UpdateRewriteFormRequest extends FormRequest
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
            'slug' => 'required|unique:rewrites,slug,' . $this->slug . ',slug',
            'meta_title' => 'required_with:slug',
            'meta_description' => 'required_with:slug',
            'meta_robots' => 'required_with:slug',
            'entity_type' => 'required',
            'entity_id' => 'required',
            'is_active' => 'present',
        ];
    }
}
