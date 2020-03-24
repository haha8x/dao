<div class="modal-box-container">
    <div class="modal-title">
        <i class="til_img"></i> <strong>{{ __('Xem yêu cầu tạo DAO:id', ['id' => $daoRequestNew->id]) }}</strong>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <table style="width:100%" border="1">
                <tr>
                    <th>Vùng</th>
                    <td>{{ __(':zone_id', ['zone_id' => $daoRequestNew->zone->name]) }}</td>
                    <th>Chi nhánh:</th>
                    <td>{{ __(':branch_id', ['branch_id' => $daoRequestNew->branch->name]) }}</td>
                </tr>
                <tr>
                    <th>Tên nhân viên:</th>
                    <td>{{ __(':staff_name', ['staff_name' => $daoRequestNew->staff_name]) }}</td>
                    <th>Mã nhân viên:</th>
                    <td>{{ __(':staff_id', ['staff_id' => $daoRequestNew->staff_id]) }}</td>
                </tr>
                <tr>
                    <th>Vị trí:</th>
                    <td>{{ __(':position_id', ['position_id' => $daoRequestNew->position->name]) }}</td>
                    <th>Email:</th>
                    <td>{{ __(':email', ['email' => $daoRequestNew->email]) }}</td>
                </tr>
                <tr>
                    <th>CMND:</th>
                    <td>{{ __(':cmnd', ['cmnd' => $daoRequestNew->cmnd]) }}</td>
                    <th>Điện thoại:</th>
                    <td>{{ __(':phone', ['phone' => $daoRequestNew->phone]) }}</td>
                </tr>
                <tr>
                    <th>Trạng thái DAO:</th>
                    <td>{{ __(':level', ['level' => $daoRequestNew->level]) }}</td>
                    <th>CIF:</th>
                    <td>{{ __(':cif', ['cif' => $daoRequestNew->cif]) }}</td>
                </tr>
                <tr>
                    <th>Trạng thái xử lý:</th>
                    <td>{{ $daoRequestNew->status->toText() }}</td>
                    <th>Note:</th>
                    <td>{{ __(':note', ['note' => $daoRequestNew->note]) }}</td>
                </tr>
                <tr>
                    <th>Ngày tạo:</th>
                    <td>{{ date_from_database($daoRequestNew->created_at, config('core.base.general.date_format.date_time')) }}</td>
                    <th>Ngày cập nhật:</th>
                    <td>{{ date_from_database($daoRequestNew->updated_at, config('core.base.general.date_format.date_time')) }}</td>
                </tr>
            </table>
            <p>
                <iframe style="width:100%;margin-top:10px;" src="{{ '/storage/'.$daoRequestNew->decision_file }}#toolbar=0" width="100%" height="500px">
            </p>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn btn-primary" data-fancybox-close>{{ __('Đóng')  }}</a>
        @if ($daoRequestNew->status == 'create')
        <a href="{{ route('request-new.receive', $daoRequestNew->id) }}" class="btn btn-info">
            {{ __('Tiếp nhận') }}
        </a>
        <a href="{{ route('request-new.reject', $daoRequestNew->id) }}" class="btn btn-danger">
            {{ __('Từ chối') }}
        </a>
        @endif
        @if ($daoRequestNew->status == 'receive')
        <a href="{{ route('request-new.gdcn_approve', $daoRequestNew->id) }}" class="btn btn-info">
            {{ __('GDCN Duyệt') }}
        </a>
        <a href="{{ route('request-new.hoiso_approve', $daoRequestNew->id) }}" class="btn btn-info">
            {{ __('Hội sở Duyệt') }}
        </a>
        @endif
        @if ($daoRequestNew->status == 'gdcn_approve' || $daoRequestNew->status == 'hoiso_approve')
        <a href="{{ route('request-new.it_process', $daoRequestNew->id) }}" class="btn btn-info">
            {{ __('IT Xử lý') }}
        </a>
        @endif
        @if ($daoRequestNew->status == 'it_process')
        <a href="{{ route('request-new.success', $daoRequestNew->id) }}" class="btn btn-info">
            {{ __('Tạo DAO') }}
        </a>
        @endif

    </div>
</div>
