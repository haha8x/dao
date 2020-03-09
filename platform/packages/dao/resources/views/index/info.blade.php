<div class="modal-box-container">
    <div class="modal-title">
        <i class="til_img"></i> <strong>{{ __('Xem yêu cầu mã DAO:id', ['id' => $dao->id]) }}</strong>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <table style="width:100%" border="1">
                <tr>
                    <th>Vùng</th>
                    <td>{{ __(':zone_id', ['zone_id' => $dao->zone->name]) }}</td>
                    <th>Chi nhánh:</th>
                    <td>{{ __(':branch_id', ['branch_id' => $dao->branch->name]) }}</td>
                </tr>
                <tr>
                    <th>Tên nhân viên:</th>
                    <td>{{ __(':staff_name', ['staff_name' => $dao->staff_name]) }}</td>
                    <th>Mã nhân viên:</th>
                    <td>{{ __(':staff_id', ['staff_id' => $dao->staff_id]) }}</td>
                </tr>
                <tr>
                    <th>Vị trí:</th>
                    <td>{{ __(':position_id', ['position_id' => $dao->position->name]) }}</td>
                    <th>Email:</th>
                    <td>{{ __(':email', ['email' => $dao->email]) }}</td>
                </tr>
                <tr>
                    <th>CMND:</th>
                    <td>{{ __(':cmnd', ['cmnd' => $dao->cmnd]) }}</td>
                    <th>Điện thoại:</th>
                    <td>{{ __(':phone', ['phone' => $dao->phone]) }}</td>
                </tr>
                <tr>
                    <th>Trạng thái DAO:</th>
                    <td>{{ __(':level', ['level' => $dao->level]) }}</td>
                    <th>CIF:</th>
                    <td>{{ __(':cif', ['cif' => $dao->cif]) }}</td>
                </tr>
                <tr>
                    <th>Trạng thái xử lý:</th>
                    <td>{{ $dao->status }}</td>
                    <th>Note:</th>
                    <td>{{ __(':note', ['note' => $dao->note]) }}</td>
                </tr>
                <tr>
                    <th>Ngày tạo:</th>
                    <td>{{ date_from_database($dao->created_at, config('core.base.general.date_format.date_time')) }}</td>
                    <th>Ngày cập nhật:</th>
                    <td>{{ date_from_database($dao->updated_at, config('core.base.general.date_format.date_time')) }}</td>
                </tr>
            </table>
            <p>
                <img style="width:100%;margin-top:10px;" src="{{ '/storage/'.$dao->decision_file }}">
            </p>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn btn-primary" data-fancybox-close>{{ __('Đóng')  }}</a>
        @if ($dao->status == 'create')
        <a href="{{ route('dao-request-new.receive', $dao->id) }}" class="btn btn-info">
            {{ __('Tiếp nhận') }}
        </a>
        @endif
        @if ($dao->status == 'receive')
        <a href="{{ route('dao-request-new.reject', $dao->id) }}" class="btn btn-info">
            {{ __('Từ chối') }}
        </a>
        @endif
        @if ($dao->status == 'receive')
        <a href="{{ route('dao-request-new.approve', $dao->id) }}" class="btn btn-info">
            {{ __('Duyệt') }}
        </a>
        @endif
        @if ($dao->status == 'gdcn_approve')
        <a href="{{ route('dao-request-new.it_process', $dao->id) }}" class="btn btn-info">
            {{ __('IT Xử lý') }}
        </a>
        @endif
        @if ($dao->status == 'it_process')
        <a href="{{ route('dao-request-new.approve', $dao->id) }}" class="btn btn-info">
            {{ __('Duyệt') }}
        </a>
        @endif

    </div>
</div>
