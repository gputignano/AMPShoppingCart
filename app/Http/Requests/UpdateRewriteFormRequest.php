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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'template' => 'required',
            'rewritable_type' => 'required',
            'rewritable_id' => 'required',
        ];
    }
}
