@extends('core/base::layouts.master')
@section('content')
{!! Form::open() !!}
<div class="max-width-1200">
    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Website Logo</h2>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="website_logo">Website Logo
                            </label>
                            <div class="admin-logo-image-setting">
                                {!! Form::mediaImage('settings[website_logo]', setting('website_logo'), [
                                'allow_thumb' => false,
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="website_logo_retina">Retina Logo (2x
                                size)
                            </label>
                            <div class="admin-logo-image-setting">
                                {!! Form::mediaImage('settings[website_logo_retina]', setting('website_logo_retina'), [
                                'allow_thumb' => false,
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="website_footer_logo">Footer Logo
                            </label>
                            <div class="admin-logo-image-setting">
                                {!! Form::mediaImage('settings[website_footer_logo]', setting('website_footer_logo'), [
                                'allow_thumb' => false,
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="website_favicon">Favicon
                            </label>
                            <div class="admin-logo-image-setting">
                                {!! Form::mediaImage('settings[website_favicon]', setting('website_favicon'), [
                                'allow_thumb' => false,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>General Information</h2>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6 col-12">
                            <label class="text-title-field" for="phone_vietnam">Phone Vietnam</label>
                            <input type="text" class="next-input" name="settings[phone_vietnam]" id="phone_vietnam"
                                value="{{ setting('phone_vietnam') }}">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="text-title-field" for="hotline_vietnam">Hotline Vietnam</label>
                            <input type="text" class="next-input" name="settings[hotline_vietnam]" id="hotline_vietnam"
                                value="{{ setting('hotline_vietnam') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6 col-12">
                            <label class="text-title-field" for="phone_taiwan">Phone Taiwan</label>
                            <input type="text" class="next-input" name="settings[phone_taiwan]" id="phone_taiwan"
                                value="{{ setting('phone_taiwan') }}">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="text-title-field" for="hotline_taiwan">Hotline Taiwan</label>
                            <input type="text" class="next-input" name="settings[hotline_taiwan]" id="hotline_taiwan"
                                value="{{ setting('hotline_taiwan') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="facebook_page_id">Facebook Page ID</label>
                    <input type="number" class="next-input" name="settings[facebook_page_id]" id="facebook_page_id"
                        value="{{ setting('facebook_page_id') }}">
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="instagram">Instagram URL</label>
                    <input type="text" class="next-input" name="settings[instagram]" id="instagram"
                        value="{{ setting('instagram') }}">
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="youtube">Youtube URL</label>
                    <input type="text" class="next-input" name="settings[youtube]" id="youtube"
                        value="{{ setting('youtube') }}">
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="twitter">Twitter URL</label>
                    <input type="text" class="next-input" name="settings[twitter]" id="twitter"
                        value="{{ setting('twitter') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Themes Setting</h2>
                <span>Number of item show on website</span>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="slide_no">Slide</label>
                            <input type="number" class="next-input" name="settings[slide_no]" id="slide_no"
                                value="{{ setting('slide_no') }}">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="core_content_no">Core Content</label>
                            <input type="number" class="next-input" name="settings[core_content_no]" id="core_content_no"
                                value="{{ setting('core_content_no') }}">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="achievement_no">Achievement</label>
                            <input type="number" class="next-input" name="settings[achievement_no]" id="achievement_no"
                                value="{{ setting('achievement_no') }}">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="partner_no">Partner</label>
                            <input type="number" class="next-input" name="settings[partner_no]" id="partner_no"
                                value="{{ setting('partner_no') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="testimonial_no">Testimonial</label>
                            <input type="number" class="next-input" name="settings[testimonial_no]" id="testimonial_no"
                                value="{{ setting('testimonial_no') }}">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="news_no">News</label>
                            <input type="number" class="next-input" name="settings[news_no]" id="news_no"
                                value="{{ setting('news_no') }}">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="team_no">Team</label>
                            <input type="number" class="next-input" name="settings[team_no]" id="team_no"
                                value="{{ setting('team_no') }}">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="text-title-field" for="blog_no">Blog</label>
                            <input type="number" class="next-input" name="settings[blog_no]" id="blog_no"
                                value="{{ setting('blog_no') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
