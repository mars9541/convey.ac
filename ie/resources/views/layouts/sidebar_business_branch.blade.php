 <!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Action</li>
                <li><a href="{{url('branch/search')}}" class="waves-effect"><i class="mdi mdi-magnify"></i><span> Search </span></a></li>
                @if($CBR_info->activate_branch_direct_connect=="1")
                <li><a href="{{url('branch/direct')}}" class="waves-effect"><i class="mdi mdi-lan-connect"></i><span> Direct Connect </span></a></li>
                @endif
                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->