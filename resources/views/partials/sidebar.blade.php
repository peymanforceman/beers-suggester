<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">

            <li @if($path== __('trans.Home')) class="active" @endif>
                <a href="{{ route('home') }}">
                    <i class="fa fa-home"></i> <span>{{ __('trans.Home') }}</span>
                </a>
            </li>
            <li @if($path== __('trans.Suggest A Beer')) class="active" @endif>
                <a href="{{ route('suggest') }}">
                    <i class="fa fa-beer"></i> <span>{{ __('trans.Suggest A Beer') }}</span>
                </a>
            </li>
            <li>
                <a target="_blank" href="{{ route('api_doc') }}">
                    <i class="fa fa-book"></i> <span>{{ __('trans.API Documentation') }}</span>
                </a>
            </li>
        </ul>
    </section>
</aside>