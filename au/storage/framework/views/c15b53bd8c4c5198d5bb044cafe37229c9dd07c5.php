 <!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
           
           
            <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" height="30" alt="logo"></a>
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
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
        <li class="list-inline-item dropdown notification-list hide-sm  float-right">
            <a class="nav-link waves-effect text-white" href="<?php echo e(url('branch/logout')); ?>" >
                Logout
            </a>
        </li>

        <!-- Menu Collapse Button -->
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End --><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/au/resources/views/layouts/topbar_business_branch.blade.php ENDPATH**/ ?>