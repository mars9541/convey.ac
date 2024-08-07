 <!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li><a href="{{url('business/home')}}" class="waves-effect"><i class="mdi mdi-home-variant"></i><span> Home </span></a></li>
                <li><a href="{{url('business/getting-started')}}" class="waves-effect"><i class="mdi mdi-television-guide"></i><span> Getting Started </span></a></li>
                <li class="menu-title">Action</li>
                <li><a href="{{url('business/search')}}" class="waves-effect"><i class="mdi mdi-magnify"></i><span> Search </span></a></li>
                <li><a href="{{url('business/search-credits')}}" class="waves-effect"><i class="mdi mdi-account-search"></i><span> Search Credits </span></a></li>
                <li><a href="{{url('business/invite')}}" class="waves-effect"><i class="mdi mdi-code-array"></i><span> Invite Codes </span></a></li>
                <li id="direct_connect_li" class=" {{$connect_flag->direct_connect_flag != 0 ? "" : "d-none"}}"><a href="{{url('business/direct')}}" class="waves-effect"><i class="mdi mdi-lan-connect"></i><span> Direct Connect </span></a></li>
                <li id="hris_connect_li" class="{{$connect_flag->hris_connect_flag != 0 ? "" : "d-none"}}"><a href="{{url('business/hris')}}" class="waves-effect"><i class="mdi mdi-cast-connected"></i><span> HRIS Connect </span></a></li>
                <li id="api_connect_li" class="{{$connect_flag->api_connect_flag != 0 ? "" : "d-none"}}"><a href="{{url('business/api')}}" class="waves-effect"><i class="mdi mdi-signal-variant"></i><span> API Connect </span></a></li>
                <li><a href="{{url('business/branches')}}" class="waves-effect"><i class="mdi mdi-source-branch"></i><span> Branches </span></a></li>
                <li><a href="{{url('business/help')}}" class="waves-effect"><i class="mdi mdi-help"></i><span> Find Help </span></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
