<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('res-admin/assets/images/brand/test-logo.png') }}" class="header-brand-img desktop-logo" alt="Worder">
                <img src="{{ asset('res-admin/assets/images/brand/logo-toggle.png') }}" class="header-brand-img toggle-logo" alt="Worder">
                <img src="{{ asset('res-admin/assets/images/brand/logo-dark.png') }}" class="header-brand-img light-logo1" alt="Worder">
                <img src="{{ asset('res-admin/assets/images/brand/logo-mini-dark.png') }}" class="header-brand-img light-logo" alt="Worder">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg>
            </div>

            <ul class="side-menu">
                <li class="sub-category">
                    <h3>{{ trans('panel.dashboard.main') }}</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                        <i class="side-menu__icon fal fa-chart-bar"></i>
                        <span class="side-menu__label">{{ trans('panel.dashboard.title') }}</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navAdmin">
                        <i class="side-menu__icon fal fa-user"></i>
                        <span class="side-menu__label">{{ trans('panel.admin.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.admin.index') }}" class="slide-item">{{ trans('panel.admin.index') }}</a></li>
                        <li><a href="{{ route('admin.admin.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navRole">
                        <i class="side-menu__icon fal fa-lock"></i>
                        <span class="side-menu__label">{{ trans('panel.role.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.permission.sync') }}" class="slide-item">{{ trans('panel.permission.sync') }}</a></li>
                        <li><a href="{{ route('admin.role.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.role.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navUser">
                        <i class="side-menu__icon fal fa-user"></i>
                        <span class="side-menu__label">{{ trans('panel.user.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.user.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navCategory">
                        <i class="side-menu__icon fal fa-list"></i>
                        <span class="side-menu__label">{{ trans('panel.category.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.category.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.category.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="acfTemplate">
                        <i class="side-menu__icon fal fa-brush"></i>
                        <span class="side-menu__label">{{ trans('panel.acf.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.acf.template.index') }}" class="slide-item">{{ trans('panel.acf.template.index') }}</a></li>
                        <li><a href="{{ route('admin.acf.build.index') }}" class="slide-item">{{ trans('panel.acf.build.index') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navPage">
                        <i class="side-menu__icon fal fa-file"></i>
                        <span class="side-menu__label">{{ trans('panel.page.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.page.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.page.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navSentence">
                        <i class="side-menu__icon fal fa-language"></i>
                        <span class="side-menu__label">{{ trans('panel.sentence.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.sentence.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.sentence.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navWord">
                        <i class="side-menu__icon fal fa-language"></i>
                        <span class="side-menu__label">{{ trans('panel.word.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.word.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.word.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navExam">
                        <i class="side-menu__icon fal fa-list-check"></i>
                        <span class="side-menu__label">{{ trans('panel.exam.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.exam.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navAvatar">
                        <i class="side-menu__icon fal fa-image"></i>
                        <span class="side-menu__label">{{ trans('panel.avatar.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.avatar.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                        <li><a href="{{ route('admin.avatar.create') }}" class="slide-item">{{ trans('panel.create') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navContact">
                        <i class="side-menu__icon fal fa-phone"></i>
                        <span class="side-menu__label">{{ trans('panel.contact.index') }}</span><i class="angle fal fa-angle-left"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.contact.index') }}" class="slide-item">{{ trans('panel.list') }}</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)" id="navProfile">
                        <i class="side-menu__icon fal fa-user-edit"></i>
                        <span class="side-menu__label">{{ trans('panel.profile.index') }}</span><i class="angle fal fa-angle-left"></i>
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
