<div class="row">
    <div class="col-6">
        <div class="btn-set">
            @php do_action(BASE_ACTION_FORM_ACTIONS, 'default') @endphp
            <button type="submit" name="submit" value="save" class="btn btn-sm btn-thanh_cong">
                Đăng ký
            </button>
        </div>
    </div>
    <div class="col-6">
        <p style="float:right;"><a class="lost-pass-link"
                href="{{ route('access.login') }}">{{ trans('core/acl::auth.back_to_login') }}</a>
        </p>
    </div>
</div>