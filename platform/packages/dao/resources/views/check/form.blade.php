@extends('core/acl::auth.master')

@section('content')
<h3 class="form-title font-green">Kiểm tra thông tin DAO trên hệ thống</h3>
<div class="content-wrapper">
    {!! Form::open(['route' => 'dao.check', 'class' => 'dao-check-form']) !!}
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span></span>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Mã chi nhánh</label>
        <div class="col-sm-9">
            {!! Form::text('branch_id', old('branch_id'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Mã nhân viên</label>
        <div class="col-sm-9">
            {!! Form::text('staff_id', old('staff_id'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Email</label>
        <div class="col-sm-9">
            {!! Form::email('email', old('email'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">CMND</label>
        <div class="col-sm-9">
            {!! Form::number('cmnd', old('cmnd'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row form-actions">
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary">Kiểm tra</button>
        </div>
        <div class="col-sm-6">
            <p class="link-bottom float-right"><a href="{{ route('access.login') }}">{{ trans('core/acl::auth.back_to_login') }}</a></p>
        </div>
    </div>

    {!! Form::close() !!}
</div>
@yield('info')
@stop
