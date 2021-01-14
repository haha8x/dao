<div class="sidebar-user">
    <div class="user-pic">
        <img class="img-responsive img-rounded" src="{{ Auth::user()->avatar_url }}"
            alt="{{ Auth::user()->getFullName() }}">
    </div>
    <div class="user-info">
        <span class="user-name">
            <strong>{{ Auth::user()->getFullName() }}</strong>
        </span>
        <span
            class="user-position">{{ Auth::user()->getPosition()->first() ? Auth::user()->getPosition()->first()->name : null}}</span>
        <span
            class="user-zone-branch">{{ Auth::user()->getZone()->first() ? Auth::user()->getZone()->first()->name : null }}
            -
            {{ Auth::user()->getBranch()->first() ? Auth::user()->getBranch()->first()->name : null }}</span>
        <span class="user-status">
            <a href="{{ route('user.profile.view', Auth::user()->getKey()) }}"><i class="icon-user"></i>
                {{ trans('core/base::layouts.profile') }}</a>
        </span>
        <span class="user-status">
            <a href="{{ route('access.logout') }}" class="btn-logout"><i class="icon-key"></i>
                {{ trans('core/base::layouts.logout') }}</a>
        </span>
    </div>
</div>
@foreach ($menus = dashboard_menu()->getAll() as $menu)
<li class="nav-item @if ($menu['active']) active @endif" id="{{ $menu['id'] }}">
    <a href="{{ $menu['url'] }}" class="nav-link nav-toggle">
        <i class="{{ $menu['icon'] }}"></i>
        <span class="title">{{ trans($menu['name']) }} {!! apply_filters(BASE_FILTER_APPEND_MENU_NAME, null,
            $menu['id']) !!}</span>
        @if (isset($menu['children']) && count($menu['children'])) <span
            class="arrow @if ($menu['active']) open @endif"></span> @endif
    </a>
    @if (isset($menu['children']) && count($menu['children']))
    <ul class="sub-menu @if (!$menu['active']) hidden-ul @endif">
        @foreach ($menu['children'] as $item)
        <li class="nav-item @if ($item['active']) active @endif" id="{{ $item['id'] }}">
            <a href="{{ $item['url'] }}" class="nav-link">
                <i class="{{ $item['icon'] }}"></i>
                {{ trans($item['name']) }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</li>
@endforeach