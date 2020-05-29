<?php

namespace PhpCollective\MenuMaker\Http\Requests;

class MenuRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required|min:3|max:100',
            'alias'     => 'required|alpha_dash|min:3|max:100|unique:pcmm_menus,alias,' . $this->segment($this->segmentNo()),
            'route_list' => 'nullable',
            'link'       => 'nullable|max:100',
            'icon'       => 'nullable|max:100',
            'class'      => 'nullable|alpha_dash|max:100',
            'attr'       => 'nullable|max:100',
            'privilege'  => 'filled',
            'visible'    => 'filled|boolean',
        ];
    }
}
