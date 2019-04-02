<?php

namespace PhpCollective\MenuMaker\Http\Requests;

class RoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:pcmm_roles,name,'.$this->segment($this->segmentNo()),
        ];
    }
}
