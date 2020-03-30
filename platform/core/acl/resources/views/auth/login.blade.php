@extends('core/acl::auth.master')

@section('content')
{!! Form::open(['route' => 'access.login', 'class' => 'login-form']) !!}
<div class="form-group" id="emailGroup">
    <label>{{ trans('core/acl::auth.login.email') }}</label>
    {!! Form::text('email', old('email'), ['class' =>
    'form-control', 'placeholder' => trans('core/acl::auth.login.email')]) !!}
</div>

<div class="form-group" id="passwordGroup">
    <label>{{ trans('core/acl::auth.login.password') }}</label>
    {!! Form::input('password', 'password', (app()->environment('demo') ? '159357' : null), ['class' => 'password-field
    form-control',
    'placeholder' => trans('core/acl::auth.login.password')]) !!}
    <span toggle=".password-field" class="fa fa-fw fa-eye view-password-icon toggle-password"></span>
</div>

<div>
    <label>
        {!! Form::checkbox('remember', '1', true, ['class' => 'hrv-checkbox']) !!}
        {{ trans('core/acl::auth.login.remember') }}
    </label>
</div>
<br>

<button type="submit" class="btn btn-block login-button">
    <span class="signin">{{ trans('core/acl::auth.login.login') }}</span>
</button>
<div class="clearfix"></div>

<br>
<p><a class="lost-pass-link" href="{{ route('access.password.request') }}"
        title="{{ trans('core/acl::auth.forgot_password.title') }}">{{ trans('core/acl::auth.lost_your_password') }}</a>
</p>

<div class="login-options">
    <p>
        <a href="{{ route('dao.register') }}">Đăng ký DAO</a>
    </p>
    <p>
        <a href="{{ route('user.register') }}">Đăng ký USER (Sau khi có mã DAO được cấp)</a>
    </p>
</div>

{!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\ACL\Models\User::class) !!}

{!! Form::close() !!}
@stop
@push('footer')
<script>
    var email = document.querySelector('[name="email"]');
    var password = document.querySelector('[name="password"]');
    email.focus();
    document.getElementById('emailGroup').classList.add('focused');

    // Focus events for email and password fields
    email.addEventListener('focusin', function () {
        document.getElementById('emailGroup').classList.add('focused');
    });
    email.addEventListener('focusout', function () {
        document.getElementById('emailGroup').classList.remove('focused');
    });

    password.addEventListener('focusin', function () {
        document.getElementById('passwordGroup').classList.add('focused');
    });
    password.addEventListener('focusout', function () {
        document.getElementById('passwordGroup').classList.remove('focused');
    });
</script>
@endpush