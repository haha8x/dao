<?php

namespace Botble\Dao\Http\Requests;

use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Dao\Enums\TransferTypeEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RequestTransferRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'dao_old'   => 'required',
            // 'dao_transfer'   => 'required',
            // 'zone_id'   => 'required',
            // 'branch_id'   => 'required',
            // 'acct_no'   => 'required',
            // 'staff_id'   => 'required|numeric',
            // 'staff_name'   => 'required',
            // 'customer_name'   => 'required',
            // 'reason'   => 'required',
            // 'position_id'   => 'required',
            // 'cif'   => 'required|numeric',
            // 'email'   => 'required|email|regex:/(.*)vpbank\.com\.vn$/i|regex:/(.*)vpbank\.vn$/i',
            // 'phone'   => 'required|numeric',
            // 'reason'   => 'required',
            // 'status'   => Rule::in(RequestStatusEnum::values()),
            // 'type'   => Rule::in(TransferTypeEnum::values()),
        ];
    }
}
