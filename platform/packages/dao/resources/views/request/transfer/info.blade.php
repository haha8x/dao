<div class="modal-box-container">
    <div class="modal-title">
        <i class="til_img"></i> <strong>{{ __('Xem yêu cầu chuyển mã DAO:id', ['id' => $daoRequestTransfer->id]) }}</strong>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <table style="width:100%" border="1">
                <tr>
                    <th>Dao cũ</th>
                    <td>{{ $daoRequestTransfer->dao->dao }}</td>
                    <th>Dao mới</th>
                    <td>{{ $daoRequestTransfer->dao_transfer }}</td>
                </tr>
                <tr>
                    <th>Loại</th>
                    <td>{{ $daoRequestTransfer->type->toText() }}</td>
                    <th>Lý do</th>
                    <td>{{ $daoRequestTransfer->reason }}</td>
                </tr>
                <tr>
                    <th>Trạng thái xử lý:</th>
                    <td>{{ $daoRequestTransfer->status->toText() }}</td>
                    <th>Note:</th>
                    <td>{{ $daoRequestTransfer->note }}</td>
                </tr>
                <tr>
                    <th>Ngày tạo:</th>
                    <td>{{ date_from_database($daoRequestTransfer->created_at, config('core.base.general.date_format.date_time')) }}</td>
                    <th>Ngày cập nhật:</th>
                    <td>{{ date_from_database($daoRequestTransfer->updated_at, config('core.base.general.date_format.date_time')) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn btn-primary" data-fancybox-close>{{ __('Đóng')  }}</a>
        @if ($daoRequestTransfer->status == 'create')
        <a href="{{ route('request-transfer.receive', $daoRequestTransfer->id) }}" class="btn btn-info">
            {{ __('Tiếp nhận') }}
        </a>
        <a href="{{ route('request-transfer.reject', $daoRequestTransfer->id) }}" class="btn btn-danger">
            {{ __('Từ chối') }}
        </a>
        @endif
        @if ($daoRequestTransfer->status == 'receive')
        <a href="{{ route('request-transfer.gdcn_approve', $daoRequestTransfer->id) }}" class="btn btn-info">
            {{ __('GDCN Duyệt') }}
        </a>
        <a href="{{ route('request-transfer.hoiso_approve', $daoRequestTransfer->id) }}" class="btn btn-info">
            {{ __('Hội sở Duyệt') }}
        </a>
        @endif
        @if ($daoRequestTransfer->status == 'gdcn_approve' || $daoRequestTransfer->status == 'hoiso_approve')
        <a href="{{ route('request-transfer.it_process', $daoRequestTransfer->id) }}" class="btn btn-info">
            {{ __('IT Xử lý') }}
        </a>
        @endif
        @if ($daoRequestTransfer->status == 'it_process')
        <a href="{{ route('request-transfer.transfer_dao', $daoRequestTransfer->id) }}" class="btn btn-info">
            {{ __('Chuyển DAO') }}
        </a>
        @endif

    </div>
</div>
