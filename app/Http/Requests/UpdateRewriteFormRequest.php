<?php

namespace App\Http\Requests;

use App\Models\Entity;

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
            'rewritable_type' => 'sometimes|required',
            'rewritable_id' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'rewritable_type' => $this->rewritable_type ?? Entity::find($this->rewritable_id)->type,
        ]);
    }
}
