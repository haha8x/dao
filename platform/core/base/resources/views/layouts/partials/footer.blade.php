<div class="alert alert-danger" role="alert">
    Khuyến cáo: "Báo cáo anh/chị nhận được chứa dữ liệu vốn là tài sản của Vpbank, đặc biệt là các thông tin về khách hàng. Kính đề nghị anh/chị lưu ý và cẩn trọng khi sử dụng, lưu trữ và chia sẻ để đảm bảo không gây thất thoát"
</div>
<div class="page-footer">
    <div class="page-footer-inner">
        <div class="row">
            <div class="col-md-6">
                {!! trans('core/base::layouts.copyright', ['year' => Carbon\Carbon::now()->format('Y'), 'company' => config('core.base.general.base_name'), 'version' => get_cms_version()]) !!}
            </div>
            <div class="col-md-6 text-right">
                @if (defined('LARAVEL_START')) {{ trans('core/base::layouts.page_loaded_time') }} {{ round((microtime(true) - LARAVEL_START), 2) }}s @endif
            </div>
        </div>
    </div>
</div>
