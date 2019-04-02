<?php

namespace PhpCollective\MenuMaker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
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
    public abstract function rules();

    public function segmentNo()
    {
        return count(explode('/', config('menu.path'))) + 2;
    }
}
