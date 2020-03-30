@extends('core/base::layouts.base')

@section('body-class') login @stop

@section ('page')
<div class="login-wrapper">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ setting('admin_logo') ? get_image_url(setting('admin_logo')) : url(config('core.base.general.logo')) }}"
                alt="logo" class="logo-default" style="height: 60px;"/>
        </a>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <div class="copyright">
        <p>{!! trans('core/base::layouts.copyright', ['year' =>
            now(config('app.timezone'))->format('Y'), 'company' => setting('admin_title',
            config('core.base.general.base_name')), 'version' => get_cms_version()]) !!}</p>
    </div>
</div>
@stop