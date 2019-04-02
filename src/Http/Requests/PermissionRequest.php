<?php

namespace PhpCollective\MenuMaker\Http\Requests;

class PermissionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id.0' => 'required',
            'parent_id.1' => 'required',
            'actions' => 'array',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.0.required' => 'Select a Section',
            'parent_id.1.required' => 'Select a Menu Item',
        ];
    }
}
