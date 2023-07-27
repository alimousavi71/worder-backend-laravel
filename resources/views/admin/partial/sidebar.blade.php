<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('res-admin/assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg>
            </div>

            <ul class="side-menu">
                <li class="sub-category">
                    <h3>ماژول های اصلی</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">داشبورد</span>
                    </a>
                </li>
                <li class="sub-category">
                    <h3>تنظیمات</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navAdmin">
                        <i class="side-menu__icon fe fe-user"></i>
                        <span class="side-menu__label">{{ trans('panel.admin.index') }}</span><i class="angle fe fe-chevron-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.admin.index') }}" class="slide-item">لیست</a></li>
                        <li><a href="{{ route('admin.admin.create') }}" class="slide-item"> ایجاد</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navRole">
                        <i class="side-menu__icon fe fe-lock"></i>
                        <span class="side-menu__label">{{ trans('panel.role.index') }}</span><i class="angle fe fe-chevron-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.permission.sync') }}" class="slide-item">{{ trans('panel.permission.sync') }}</a></li>
                        <li><a href="{{ route('admin.role.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.role.create') }}" class="slide-item"> {{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navCategory">
                        <i class="side-menu__icon fe fe-list"></i>
                        <span class="side-menu__label">{{ trans('panel.category.index') }}</span><i class="angle fe fe-chevron-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.category.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.category.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>





                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navContact">
                        <i class="side-menu__icon fe fe-phone"></i>
                        <span class="side-menu__label">تماس ها</span><i class="angle fe fe-chevron-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.contact.index') }}" class="slide-item">لیست</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navProfile">
                        <i class="side-menu__icon fe fe-user-check"></i>
                        <span class="side-menu__label">{{ trans('panel.profile.index') }}</span><i class="angle fe fe-chevron-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.profile.index') }}" class="slide-item">{{ trans('panel.profile.edit') }}</a></li>
                        <li><a href="{{ route('admin.profile.password') }}" class="slide-item">{{ trans('panel.profile.password-change') }}</a></li>
                        <li><a href="{{ route('admin.profile.logout') }}" class="slide-item">{{ trans('panel.profile.sign-out') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
