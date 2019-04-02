<?php

namespace PhpCollective\MenuMaker\Http\Requests;

class MenuRoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id'   => 'required',
            'section_id' => 'required',
            'menu_ids'   => 'required',
        ];
    }
}
