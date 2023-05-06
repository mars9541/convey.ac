 <!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Action</li>
                <li><a href="<?php echo e(url('branch/search')); ?>" class="waves-effect"><i class="mdi mdi-magnify"></i><span> Search </span></a></li>
                <?php if($CBR_info->activate_branch_direct_connect=="1"): ?>
                <li><a href="<?php echo e(url('branch/direct')); ?>" class="waves-effect"><i class="mdi mdi-lan-connect"></i><span> Direct Connect </span></a></li>
                <?php endif; ?>
                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End --><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ca/resources/views/layouts/sidebar_business_branch.blade.php ENDPATH**/ ?>