@extends('core/base::layouts.master')
@section('content')
{!! Form::open(['route' => ['settings.edit']]) !!}
<div class="max-width-1200">
    <div class="flexbox-annotated-section">

        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>{{ trans('core/setting::setting.general.general_block') }}</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">{{ trans('core/setting::setting.general.description') }}</p>
            </div>
        </div>

        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field"
                        for="admin_email">{{ trans('core/setting::setting.general.admin_email') }}</label>
                    <input type="email" class="next-input" name="admin_email" id="admin_email"
                        value="{{ setting('admin_email') }}">
                </div>

                <div class="form-group">
                    <label class="text-title-field"
                        for="time_zone">{{ trans('core/setting::setting.general.time_zone') }}
                    </label>
                    <div class="ui-select-wrapper">
                        <select name="time_zone" class="ui-select form-control select-search-full" id="time_zone">
                            @foreach(DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $timezone)
                            <option value="{{ $timezone }}" @if (setting('time_zone', 'UTC' )===$timezone) selected
                                @endif>{{ $timezone }}</option>
                            @endforeach
                        </select>
                        <svg class="svg-next-icon svg-next-icon-size-16">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                        </svg>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="flexbox-annotated-section">

        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>{{ trans('core/setting::setting.general.admin_appearance_title') }}</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">{{ trans('core/setting::setting.general.admin_appearance_description') }}</p>
            </div>
        </div>

        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field"
                        for="admin-logo">{{ trans('core/setting::setting.general.admin_logo') }}
                    </label>
                    <div class="admin-logo-image-setting">
                        {!! Form::mediaImage('admin_logo', setting('admin_logo'), ['allow_thumb' => false]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-title-field"
                        for="admin-favicon">{{ trans('core/setting::setting.general.admin_favicon') }}
                    </label>
                    <div class="admin-favicon-image-setting">
                        {!! Form::mediaImage('admin_favicon', setting('admin_favicon'), ['allow_thumb' => false]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-title-field"
                        for="admin_title">{{ trans('core/setting::setting.general.admin_title') }}</label>
                    <input data-counter="120" type="text" class="next-input" name="admin_title" id="admin_title"
                        value="{{ setting('admin_title', config('app.name')) }}">
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>{{ trans('core/setting::setting.general.cache_block') }}</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">{{ trans('core/setting::setting.general.cache_description') }}</p>
            </div>
        </div>

        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">

                <div class="form-group">
                    <label class="text-title-field"
                        for="enable_cache">{{ trans('core/setting::setting.general.enable_cache') }}
                    </label>
                    <label class="hrv-label">
                        <input type="radio" name="enable_cache" class="hrv-radio" value="1" @if                            (setting('enable_cache')) checked @endif>
                        {{ trans('core/setting::setting.general.yes') }}
                    </label>
                    <label class="hrv-label">
                        <input type="radio" name="enable_cache" class="hrv-radio" value="0" @if                            (!setting('enable_cache')) checked @endif>
                        {{ trans('core/setting::setting.general.no') }}
                    </label>
                </div>

                <div class="form-group">
                    <label class="text-title-field"
                        for="cache_time">{{ trans('core/setting::setting.general.cache_time') }}</label>
                    <input type="number" class="next-input" name="cache_time" id="cache_time"
                        value="{{ setting('cache_time', 10) }}">
                </div>
            </div>
        </div>
    </div>

    {!! apply_filters(BASE_FILTER_AFTER_SETTING_CONTENT, null) !!}

    <div class="flexbox-annotated-section" style="border: none">
        <div class="flexbox-annotated-section-annotation">
            &nbsp;
        </div>
        <div class="flexbox-annotated-section-content">
            <button class="btn btn-info" type="submit">{{ trans('core/setting::setting.save_settings') }}</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection