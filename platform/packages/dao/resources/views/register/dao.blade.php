@extends('core/acl::auth.master')

@section('content')
<h3 class="form-title font-green">Đăng ký DAO</h3>
<div class="content-wrapper">
    {!! Form::open(['route' => 'dao.register', 'class' => 'dao-register-form']) !!}
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span></span>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">Vùng</label>
        <div class="col-sm-9">
            {!! Form::select('zone', array(
            '1' => 'Vùng 1',
            '2' => 'Vùng 2',
            '3' => 'Vùng 3',
            '4' => 'Vùng 4',
            '5' => 'Vùng 5',
            '6' => 'Vùng 6',
            '7' => 'Vùng 7',
            '8' => 'Vùng 8',
            '9' => 'Vùng 9',
            '10' => 'Vùng 10',
            '11' => 'Vùng 11'
            ), '1', ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Mã chi nhánh</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Họ và tên</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Chức danh</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Trạng thái DAO</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Mã nhân viên</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">CIF</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Email</label>
        <div class="col-sm-9">
            {!! Form::email('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">CMND</label>
        <div class="col-sm-9">
            {!! Form::number('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Số điện thoại</label>
        <div class="col-sm-9">
            {!! Form::number('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">QĐ / Thư mời làm việc</label>
        <div class="col-sm-9">
            {!! Form::file('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row form-actions">
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Đăng ký DAO</button>
        </div>
        <div class="col-sm-6">
            <p class="link-bottom float-right"><a href="{{ route('access.login') }}">{{ trans('core/acl::auth.back_to_login') }}</a></p>
        </div>
    </div>

    {!! Form::close() !!}
</div>
@stop
