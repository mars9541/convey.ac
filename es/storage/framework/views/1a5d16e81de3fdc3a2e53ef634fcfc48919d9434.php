<!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <!-- <a href="index.html" class="logo text-center"><img src="assets/images/flags/germany_flag.jpg" alt="" height="16"/></a> -->
                        

                        <a href="<?php echo e(url('business/home')); ?>" class="logo"><img id="convey_logo" src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" height="30" alt="logo"></a>

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
                        <a class="nav-link waves-effect text-white" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" id="btn-logout">
                            Logout
                        </a>
                    </li>

                    <li class="list-inline-item dropdown notification-list hide-sm float-right">
                        <a class="nav-link waves-effect text-white" href="<?php echo e(url('business/settings')); ?>" id="btn-setting">
                            Settings
                        </a>
                    </li>

                    <li class="list-inline-item dropdown notification-list hide-sm float-right">
                        <a class="nav-link waves-effect text-white" href="<?php echo e(url('business/contact')); ?>" id="btn-contactus">
                            Contact Us
                        </a>
                    </li>

                    <li class="list-inline-item dropdown notification-list float-right" id="message_event">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="ion-ios7-bell noti-icon"></i>
                            <span class="badge <?php echo e($new_ticket_count > 0 ? 'badge-danger' : ''); ?> noti-icon-badge"></span>
                        </a>
                        <?php if($new_ticket_count > 0): ?>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="<?php echo e(route('business.contact')); ?>" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details"><b>New Message received</b><small class="text-muted" id="message_cnt">You have <?php echo e($new_ticket_count); ?> unread messages</small></p>
                                </a>

                                <!-- All-->
                                

                            </div>
                        <?php endif; ?>
                    </li>

                    <!-- Menu Collapse Button -->
                    <button type="button" class="button-menu-mobile open-left waves-effect">
                        <i class="ion-navicon"></i>
                    </button>

                    <div class="clearfix"></div>
                </nav>

            </div>
            <!-- Top Bar End -->

<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/layouts/topbar_business.blade.php ENDPATH**/ ?>