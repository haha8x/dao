<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class UpdateProfileRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:120|min:2',
            'email'      => 'required|max:60|min:6|email',
        ];
    }
}
