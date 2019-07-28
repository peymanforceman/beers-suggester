<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini">{{ __('trans.Beer suggester') }}</span>
        <span class="logo-lg">{{ __('trans.Beer suggester') }}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ __('trans.Toggle navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" onclick="update_database()">
                        {{ __('trans.Update Database') }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="modal fade" id="update_db_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('trans.Updating Database') }}</h4>
            </div>
            <div class="modal-body">
                <img style="margin: 0 auto;display: block;max-height: 200px;" src="{{URL::asset('img/loading.gif') }}"/>
            </div>
        </div>
    </div>
</div>