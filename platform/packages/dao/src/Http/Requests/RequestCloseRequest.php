<?php

namespace Botble\Dao\Http\Requests;

use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RequestCloseRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dao'   => 'required',
            'zone_id'   => 'required',
            'branch_id'   => 'required',
            'staff_id'   => 'required|numeric',
            'staff_name'   => 'required',
            'position_id'   => 'required',
            'cif'   => 'required|numeric',
            // 'email'   => 'required|email|regex:/(.*)vpbank\.com\.vn$/i|regex:/(.*)vpbank\.vn$/i',
            'email'   => 'required|email|regex:/(.*)vpbank\.com\.vn$/i',
            'cmnd'   => 'required|numeric',
            'from_date'   => 'required|date',
            'to_date'   => 'nullable|date',
            // 'note'   => 'required',
            // 'status'   => Rule::in(RequestStatusEnum::values()),
        ];
    }
}
