@extends('core/acl::auth.master')

@section('content')
<h3 class="form-title font-green">Đăng ký DAO</h3>
<div class="content-wrapper">
    {!! Form::open(['route' => 'dao.register', 'class' => 'dao-register-form']) !!}
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span></span>
    </div>
    <div class="form-group">
        <label class="control-label">Vùng</label>
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

    <div class="form-group">
        <label>Mã chi nhánh</label>
        {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>Họ và tên</label>
        {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>Chức danh</label>
        {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>Trạng thái DAO</label>
        {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>Mã nhân viên</label>
        {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>CIF</label>
        {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>Email</label>
        {!! Form::email('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>CMND</label>
        {!! Form::number('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>Số điện thoại</label>
        {!! Form::number('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group">
        <label>QĐ / Thư mời làm việc</label>
        {!! Form::file('username', old('username'), ['class' => 'form-control form-control-solid
        placeholder-no-fix']) !!}
    </div>

    <div class="form-group row form-actions">
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Đăng ký DAO</button>
        </div>
        <div class="col-sm-6">
            <p class="link-bottom float-right"><a
                    href="{{ route('access.login') }}">{{ trans('core/acl::auth.back_to_login') }}</a>
            </p>
        </div>
        {!! Form::close() !!}
    </div>
    @stop