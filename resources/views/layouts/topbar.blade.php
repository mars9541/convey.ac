 <!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
           
           
            <a href="{{url('/')}}" class="logo"><img src="{{ URL::asset('assets/images/logo.png')}}" height="20" alt="logo"></a>
        </div>
    </div>

    <nav class="navbar-custom">
        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
                <input class="search-input" type="search" placeholder="Search" />
                <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                    <i class="mdi mdi-close-circle"></i>
                </a>
            </div>
        </div>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <li class="list-inline-item dropdown notification-list hide-sm  float-right">
            <a class="nav-link waves-effect text-white" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"  id="btn-logout">
                Logout
            </a>
        </li>
        @if (Auth::user()->user_role == 'globalteamadmin')
        <!-- notification-->
        <li class="list-inline-item dropdown notification-list float-right" id="message_event">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="ion-ios7-bell noti-icon"></i>
                <span class="badge {{$new_message>0?'badge-danger':''}} noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5>Notification</h5>
                </div>

                <!-- item-->
                <a href="{{route('team.inbox')}}" class="dropdown-item notify-item">
                    <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                    <p class="notify-details"><b>New Message received</b><small class="text-muted" id="message_cnt">You have {{$new_message}} unread messages</small></p>
                    
                </a>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    View All
                </a>

            </div>
        </li>
        @endif


        <!-- Menu Collapse Button -->
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->