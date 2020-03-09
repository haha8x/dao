@extends('core/acl::auth.master')

@section('content')
<h3 class="form-title font-green">Đăng ký User</h3>
<div class="content-wrapper">
    {!! Form::open(['route' => 'access.register.dao', 'class' => 'register-daodao-form']) !!}
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span></span>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">Staff ID</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Username</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Password</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Branch Code</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Zone ID</label>
        <div class="col-sm-9">
            {!! Form::text('username', old('username'), ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Trạng thái</label>
        <div class="col-sm-9">
            {!! Form::checkbox('name', 'value', true) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">Chức vụ</label>
        <div class="col-sm-9">
            {!! Form::checkbox('name', 'value') !!}
            {!! Form::checkbox('name', 'value') !!}
            {!! Form::checkbox('name', 'value') !!}
            {!! Form::checkbox('name', 'value') !!}
        </div>
    </div>

    <div class="form-group row form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Đăng ký User</button>
    </div>

    {!! Form::close() !!}

    <p class="link-bottom"><a href="{{ route('access.login') }}">{{ trans('core/acl::auth.back_to_login') }}</a></p>
</div>
@stop
