<div class="modal-box-container">
    <div class="modal-title">
        <i class="til_img"></i> <strong>{{ __('Xem yêu cầu tạo DAO:id', ['id' => $item->id]) }}</strong>
    </div>
    <div class="modal-body">
        <div class="request-action" style="float: right;margin-bottom: 10px;">
            <a href="javascript:;" class="btn btn-primary" data-fancybox-close>{{ __('Đóng')  }}</a>
            @if ($item->status == 'create')
            @if (Auth::user()->hasPermission('request-new.receive'))
            <a href="{{ route('request-new.receive', $item->id) }}" class="btn btn-info">
                {{ __('Tiếp nhận') }}
            </a>
            @endif
            @if (Auth::user()->hasPermission('request-new.reject'))
            <a href="{{ route('request-new.reject', $item->id) }}" class="btn btn-danger">
                {{ __('Từ chối') }}
            </a>
            @endif
            @endif
            @if ($item->status == 'receive')
            @if (Auth::user()->hasPermission('request-new.gdcn_approve'))
            <a href="{{ route('request-new.gdcn_approve', $item->id) }}" class="btn btn-info">
                {{ __('GDCN Duyệt') }}
            </a>
            @endif
            @if (Auth::user()->hasPermission('request-new.hoiso_approve'))
            <a href="{{ route('request-new.hoiso_approve', $item->id) }}" class="btn btn-info">
                {{ __('Hội sở Duyệt') }}
            </a>
            @endif
            @endif
            @if ($item->status == 'gdcn_approve' || $item->status == 'hoiso_approve')
            @if (Auth::user()->hasPermission('request-new.it_process'))
            <a href="{{ route('request-new.it_process', $item->id) }}" class="btn btn-info">
                {{ __('IT Xử lý') }}
            </a>
            @endif
            @endif
            @if ($item->status == 'it_process')
            @if (Auth::user()->hasPermission('request-new.success'))
            <a href="{{ route('request-new.success', $item->id) }}" class="btn btn-info">
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
            <p>
                <iframe style="width:100%;margin-top:10px;"
                    src="{{ '/storage/'.$item->decision_file }}#toolbar=0" width="100%" height="300px">
            </p>
        </div>
    </div>
</div>