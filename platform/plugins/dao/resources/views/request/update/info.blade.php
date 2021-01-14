<div class="modal-box-container">
    <div class="modal-title">
        <i class="til_img"></i>
        <strong>{{ __('Xem yêu cầu cập nhật DAO:id', ['id' => $item->id]) }}</strong>
    </div>
    <div class="modal-body">
        <div class="request-action" style="float: right;margin-bottom: 10px;">
            <a href="javascript:;" class="btn btn-primary" data-fancybox-close>{{ __('Đóng')  }}</a>
            @if ($item->status == 'tao_moi')
            @if (Auth::user()->hasPermission('request-update.tiep_nhan'))
            <a href="{{ route('request-update.tiep_nhan', $item->id) }}" class="btn btn-info">
                {{ __('Tiếp nhận') }}
            </a>
            @endif
            @if (Auth::user()->hasPermission('request-update.tu_choi'))
            <a href="{{ route('request-update.tu_choi', $item->id) }}" class="btn btn-danger">
                {{ __('Từ chối') }}
            </a>
            @endif
            @endif
            @if ($item->status == 'tiep_nhan')
            @if (Auth::user()->hasPermission('request-update.gdcn_duyet'))
            <a href="{{ route('request-update.gdcn_duyet', $item->id) }}" class="btn btn-info">
                {{ __('GDCN Duyệt') }}
            </a>
            @endif
            @if (Auth::user()->hasPermission('request-update.hoiso_duyet'))
            <a href="{{ route('request-update.hoiso_duyet', $item->id) }}" class="btn btn-info">
                {{ __('Hội sở Duyệt') }}
            </a>
            @endif
            @endif
            @if ($item->status == 'gdcn_duyet' || $item->status == 'hoiso_duyet')
            @if (Auth::user()->hasPermission('request-update.it_xuly'))
            <a href="{{ route('request-update.it_xuly', $item->id) }}" class="btn btn-info">
                {{ __('IT Xử lý') }}
            </a>
            @endif
            @endif
            @if ($item->status == 'it_xuly')
            @if (Auth::user()->hasPermission('request-update.thanh_cong'))
            <a href="{{ route('request-update.thanh_cong', $item->id) }}" class="btn btn-info">
                {{ __('Thành công') }}
            </a>
            @endif
            @endif
        </div>
        <div class="form-body">
            <table style="width:100%" border="1">
                <tr>
                    <th>Vùng</th>
                    <td>{{ $item->zone ? $item->zone->name : null }}</td>
                    <th>Chi nhánh:</th>
                    <td>{{ $item->branch ? $item->branch->name : null }}</td>
                </tr>
                <tr>
                    <th>DAO cũ:</th>
                    <td>{{ $item->dao_old }}</td>
                    <th>DAO thay đổi:</th>
                    <td>{{ $item->dao_update }}</td>
                </tr>
                <tr>
                    <th>Ngày cấp DAO:</th>
                    <td>{{ date_from_database($item->from_date, config('core.base.general.date_format.date')) }}
                    </td>
                    <th>Ngày hết hạn DAO:</th>
                    <td>{{ date_from_database($item->to_date, config('core.base.general.date_format.date')) }}
                    </td>
                </tr>
                <tr>
                    <th>Tên nhân viên:</th>
                    <td>{{ $item->staff_name }}</td>
                    <th>Mã nhân viên:</th>
                    <td>{{ $item->staff_id }}</td>
                </tr>
                <tr>
                    <th>Vị trí:</th>
                    <td>{{ $item->position ? $item->position->name : null }}</td>
                    <th>Email:</th>
                    <td>{{ $item->email }}</td>
                </tr>
                <tr>
                    <th>CMND:</th>
                    <td>{{ $item->cmnd }}</td>
                    <th>Điện thoại:</th>
                    <td>{{ $item->phone }}</td>
                </tr>
                <tr>
                    <th>Trạng thái DAO:</th>
                    <td>60</td>
                    <th>CIF:</th>
                    <td>{{ $item->cif }}</td>
                </tr>
                <tr>
                    <th>Trạng thái xử lý:</th>
                    <td>{{ $item->status ? $item->status->toText() : null }}</td>
                    <th>Note:</th>
                    <td>{{ $item->note }}</td>
                </tr>
                <tr>
                    <th>Ngày tạo:</th>
                    <td>{{ date_from_database($item->created_at, config('core.base.general.date_format.date_time')) }}
                    </td>
                    <th>Ngày cập nhật:</th>
                    <td>{{ date_from_database($item->updated_at, config('core.base.general.date_format.date_time')) }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>