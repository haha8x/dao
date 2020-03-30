<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class CreateUserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|max:60|min:2',
            // 'first_name'            => 'required|max:60|min:2',
            // 'last_name'             => 'required|max:60|min:2',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            // 'username'              => 'required|min:4|max:30|unique:users',
            'zone_id'   => 'required',
            'branch_id'   => 'required',
            'staff_id'   => 'required|numeric|unique:users',
            'position_id'   => 'required',
            'email'   => 'required|regex:/(.*)vpbank\.com\.vn$/i|max:60|min:6|email|unique:users',
        ];
    }
}
