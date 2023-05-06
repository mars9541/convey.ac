<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li><a href="<?php echo e(url('advisors/home')); ?>" class="waves-effect"><i class="mdi mdi-home-variant"></i><span> Home </span></a></li>
                <li><a href="<?php echo e(url('advisors/settings')); ?>" class="waves-effect"><i class="mdi mdi-settings"></i><span> Settings </span></a></li>
                <li><a href="<?php echo e(url('advisors/country_access')); ?>" class="waves-effect"><i class="mdi mdi-account"></i><span> Country Access </span></a></li>

                <li class="menu-title">Action</li>
                <li><a href="<?php echo e(url('advisors/search')); ?>" class="waves-effect <?php echo e(Auth::user()->advisors_type == 'advisor' ? "" : "d-none"); ?>"><i class="mdi mdi-magnify"></i><span> Search </span></a></li>
                <li><a href="<?php echo e(url('advisors/search-credits')); ?>" class="waves-effect <?php echo e(Auth::user()->advisors_type == 'advisor' ? "" : "d-none"); ?>"><i class="mdi mdi-account-search"></i><span> Search Credits </span></a></li>
                <li><a href="<?php echo e(url('advisors/invite')); ?>" class="waves-effect"><i class="mdi mdi-code-array"></i><span> Invite Codes </span></a></li>

                <li class="menu-title">Learn</li>
                <li><a href="<?php echo e(url('advisors/getting-started')); ?>" class="waves-effect"><i class="mdi mdi-television-guide"></i><span> Getting Started </span></a></li>
                <li><a href="<?php echo e(url('advisors/direct')); ?>" class="waves-effect"><i class="mdi mdi-lan-connect"></i><span> Direct Connect </span></a></li>
                <li><a href="<?php echo e(url('advisors/hris')); ?>" class="waves-effect"><i class="mdi mdi-cast-connected"></i><span> HRIS Connect </span></a></li>
                <li><a href="<?php echo e(url('advisors/api')); ?>" class="waves-effect"><i class="mdi mdi-signal-variant"></i><span> API Connect </span></a></li>
                <li><a href="<?php echo e(url('advisors/branches')); ?>" class="waves-effect"><i class="mdi mdi-source-branch"></i><span> Branches </span></a></li>
                <li><a href="<?php echo e(url('advisors/help')); ?>" class="waves-effect"><i class="mdi mdi-help"></i><span> Find Help </span></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ru/resources/views/layouts/sidebar_advisors.blade.php ENDPATH**/ ?>