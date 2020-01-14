@extends('core/base::layouts.base')

@section('body-class')
login
@stop

@section ('page')
<div class="login-wrapper">
    <div>
        <div class="content">
            @yield('content')
        </div>
        <div class="copyright">
            <!-- <p>
                Khuyến cáo: "Báo cáo anh/chị nhận được chứa dữ liệu vốn là tài sản của Vpbank, đặc biệt là các thông tin về khách hàng.
            </p>
            <p>
                Kính đề nghị anh/chị lưu ý và cẩn trọng khi sử dụng, lưu trữ và chia sẻ để đảm bảo không gây thất thoát"
            </p> -->
        </div>
    </div>
</div>
@stop
