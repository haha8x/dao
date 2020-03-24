<?php

namespace Botble\Dao\Http\Requests;

use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RequestNewRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zone_id'   => 'required',
            'branch_id'   => 'required',
            'staff_id'   => 'required|numeric',
            'staff_name'   => 'required',
            'position_id'   => 'required',
            'cif'   => 'required|numeric',
            'email'   => 'required|email|regex:/(.*)vpbank\.com\.vn$/i',
            'cmnd'   => 'required|numeric',
            'phone'   => 'required|numeric',
            'decision_file'   => 'required',
            'status'   => Rule::in(RequestStatusEnum::values()),
        ];
    }
}
