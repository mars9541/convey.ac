<?php $__env->startSection('css'); ?>
<style>
    .ion-edit:hover {
        cursor: pointer;
    }
    .loading-show2{
        display: inline-block;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(url('advisors/home')); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Settings</a></li>
                </ol>
            </div>
            <h4 class="page-title">Manage Your Settings</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <?php if($email_verify == 0): ?>
        <div class="col-md-12 text-center px-0">
            <div class="alert alert-convey-danger bg-rich-red text-white" role="alert">
                
                Account restricted, please verify your email address
            </div>
        </div>
    <?php endif; ?>

    <div class="col-md-12 bg-white">
        <div class="card-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#account_settings" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-search"></i></span>
                        <span class="d-none d-sm-inline-block">Account Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#account_details" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-th-list"></i></span>
                        <span class="d-none d-sm-inline-block">Account Details</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#tab_list_service" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-th-list"></i></span>
                        <span class="d-none d-sm-inline-block">List your Service</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="account_settings" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <span id="settings_form_result"></span>
                            <form id="update_account">
                                <div class="col-md-12 m-t-30">
                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline">User Account Number: </label>
                                    <div class="col-md-9 display-inline">
                                        <input type="text" class="form-control" value="<?php echo e(Auth::user()->id); ?>" readonly />
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-30">
                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline align-top">User Email: </label>
                                    <div class="col-md-9 display-inline">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo e(Auth::user()->email); ?>" />
                                        <small style="display: none;" id="free_email_error" class="text-danger">You cannot use a free email address.
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-11 m-t-30">
                                    <button type="button" class="btn bg-emerald text-white float-right waves-effect waves-light" id="resend_email_btn">
                                        <div style="display:none;" class="loading-show2">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div> &nbsp;Resend Confirmation Email
                                    </button>
                                </div>
                                <div class="col-md-12 m-t-40 display-inline">
                                    <label class="col-form-label col-md-2 text-right color-black-light" for="password">Password: </label>
                                    <div class="col-md-9 display-inline">
                                        <input type="text" class="form-control" name="password" id="password" />
                                        <div class="">
                                            <ul class="parsley-errors-list float-left" id="password_error">
                                                <li class="parsley-required">Passwords need to be 8 characters or more.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('password').value = "***************";
                                    </script>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-2 text-right color-black-light" for="business_type">Business Type: </label>
                                    <div class="col-md-9 display-inline">
                                        <select class="custom-select" name="business_type" disabled>
                                            <option value="company" <?php echo e(Auth::user()->business_type == 'company' ? 'selected' : ''); ?>>Company</option>
                                            <option value="organisation" <?php echo e(Auth::user()->business_type == 'organisation' ? 'selected' : ''); ?>>Organisation</option>
                                            <option value="selfemployed" <?php echo e(Auth::user()->business_type == 'selfemployed' ? 'selected' : ''); ?>>Self Employed</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 m-t-30 display-inline text-center">
                                    <div class="col-md-2"></div>

                                    <input type="radio" id="a" <?php echo e($user_info->advisors_type=='developer' ? 'checked' : 'disabled'); ?> >
                                    <label class="col-form-label col-md-2 text-left color-black-light" for="a">Developer</label>

                                    <input type="radio" value="tracking" id="b" <?php echo e($user_info->advisors_type=='advisor'?'checked':'disabled'); ?> >
                                    <label class="col-form-label col-md-2 text-left color-black-light" for="b">Advisor</label>

                                    <input type="radio" id="c" <?php echo e($user_info->advisors_type=='writer'?'checked':'disabled'); ?> >
                                    <label class="col-form-label col-md-2 text-left color-black-light" for="c">Recruiter</label>
                                </div>

                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="market">Market: </label>
                                    <div class="col-md-9 display-inline">
                                        <select class="custom-select" name="market">
                                            <?php $__currentLoopData = $market; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->name); ?>" <?php echo e($user_info->market==$item->name?'selected':''); ?>><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-2 text-right color-black-light" for="employees">Number of Employees: </label>
                                    <div class="col-md-9 display-inline">
                                        <select class="custom-select" name="employees">
                                            <option value="1-9" <?php echo e($user_info->employees=='1-9'?'selected':''); ?>>1-9</option>
                                            <option value="10-99" <?php echo e($user_info->employees=='10-99'?'selected':''); ?>>10-99</option>
                                            <option value="100-250" <?php echo e($user_info->employees=='100-250'?'selected':''); ?>>100-250</option>
                                            <option value="251+" <?php echo e($user_info->employees=='251+'?'selected':''); ?>>251+</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-11 m-t-30">
                                    <button type="submit" class="btn bg-emerald text-white float-right waves-effect waves-light ml-1">
                                        &nbsp;
                                        Save Changes
                                        &nbsp;
                                    </button>

                                </div>
                        </form>
                    </div>
                  </div>
                </div>

                <div class="tab-pane p-3" id="account_details" role="tabpanel">
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <span id="form_result"></span>
                        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($user_info->business_type=='organisation'): ?>
                                <div class="col-md-12 m-t-30  display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Organisation Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ocb_name" value="<?php echo e($user_info->ocb_name); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Organisation Headquarter - House/Building Number:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_HBN" value="<?php echo e($user_info->company_ma_HBN); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Organisation Headquarter - Street/Road:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_street" value="<?php echo e($user_info->company_ma_street); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Organisation Headquarter - Town/City:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_town_or_city" value="<?php echo e($user_info->company_ma_town_or_city); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Organisation Headquarter - Country:</label>
                                    <div class="col-md-7 display-inline">
                                      <input type="hidden" value="CA" name="company_lrd_country">
                                        <select class="form-control" name="company_lrd_country_show" required disabled>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $key == "CA" ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Organisation Headquarter - Postcode:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_postcode" value="<?php echo e($user_info->company_ma_postcode); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">VAT: (If registered)</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="VAT_if_registered" value="<?php echo e($user_info->VAT_if_registered); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Legal Representatives - First Name: </label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="lrd_firstname" value="<?php echo e($user_info->lrd_firstname); ?>" required/>
                                    </div>

                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Legal Representatives - Last Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="lrd_lastname" value="<?php echo e($user_info->lrd_lastname); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Legal Representatives - Date Of Birth:</label>
                                    <div class="col-md-7  display-inline">
                                        <div class="input-group ">
                                            <input type="date" max="9999-12-31" class="form-control display-inline" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="lrd_DOB" value="<?php echo e($user_info->lrd_DOB); ?>" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Legal Representatives - Country:</label>
                                    <div class="col-md-7 display-inline">
                                        <select class="form-control" name="lrd_country" required>

                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $user_info->lrd_country == $key ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Legal Representatives - Nationality:</label>
                                    <div class="col-md-7 display-inline">
                                        <select class="form-control" name="lrd_nationality" required>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $user_info->lrd_nationality == $key ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - House/Building Number:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_HBN" value="<?php echo e($user_info->ma_HBN); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Street/Road:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_street" value="<?php echo e($user_info->ma_street); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Town/City:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_town_or_city" value="<?php echo e($user_info->ma_town_or_city); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Postcode:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_postcode" value="<?php echo e($user_info->ma_postcode); ?>" />
                                    </div>

                                </div>
                                <hr>

                            <?php elseif($user_info->business_type=='company'): ?>

                                <div class="col-md-12 m-t-30  display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Company Name:</label>

                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ocb_name" value="<?php echo e($user_info->ocb_name); ?>" required/>
                                    </div>
                                </div>

                                <div class="col-md-12 m-t-30  display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light align-top">Company Number:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_no" value="<?php echo e($user_info->company_no); ?>" required/>
                                        <small style="display: none;" id="company_no_error" class="text-danger">
                                            Must be a 9 digit Canada company number at least.
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Company Headquarter - House/Building Number:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_HBN" value="<?php echo e($user_info->company_ma_HBN); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Company Headquarter - Street/Road:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_street" value="<?php echo e($user_info->company_ma_street); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Company Headquarter - Town/City:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_town_or_city" value="<?php echo e($user_info->company_ma_town_or_city); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Company Headquarter - Country:</label>
                                    <div class="col-md-7 display-inline">
                                      <input type="hidden" value="CA" name="company_lrd_country">
                                        <select class="form-control" name="company_lrd_country_show" required disabled>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $key == "CA" ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Company Headquarter - Postcode:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="company_ma_postcode" value="<?php echo e($user_info->company_ma_postcode); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">VAT: (If registered)</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="VAT_if_registered" value="<?php echo e($user_info->VAT_if_registered); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Director - First Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="lrd_firstname" value="<?php echo e($user_info->lrd_firstname); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Director - Last Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="lrd_lastname" value="<?php echo e($user_info->lrd_lastname); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Director - Date Of Birth:</label>

                                    <div class="col-md-7  display-inline">
                                        <div class="input-group ">
                                            <input type="date" max="9999-12-31" class="form-control display-inline" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="lrd_DOB" value="<?php echo e($user_info->lrd_DOB); ?>" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Director - Country:</label>
                                    <div class="col-md-7 display-inline">
                                        <select class="form-control" name="lrd_country" required>

                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $user_info->lrd_country == $key ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Director - Nationality:</label>
                                    <div class="col-md-7 display-inline">
                                        <select class="form-control" name="lrd_nationality" required>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $user_info->lrd_nationality == $key ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - House/Building Number:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_HBN" value="<?php echo e($user_info->ma_HBN); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Street/Road:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_street" value="<?php echo e($user_info->ma_street); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Town/City:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_town_or_city" value="<?php echo e($user_info->ma_town_or_city); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Postcode:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_postcode" value="<?php echo e($user_info->ma_postcode); ?>" required/>
                                    </div>
                                </div>
                                <hr>

                            <?php elseif($user_info->business_type=='selfemployed'): ?>

                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">First Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="lrd_firstname" value="<?php echo e($user_info->lrd_firstname); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Last Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="lrd_lastname" value="<?php echo e($user_info->lrd_lastname); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Date Of Birth:</label>
                                    <div class="col-md-7  display-inline">
                                        <div class="input-group ">
                                            <input type="date" max="9999-12-31" class="form-control display-inline" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="lrd_DOB" value="<?php echo e($user_info->lrd_DOB); ?>" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Country:</label>
                                    <div class="col-md-7 display-inline">
                                      <input type="hidden" value="CA" name="lrd_country">

                                        <select class="form-control" name="lrd_country_show" required disabled>

                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $key == "CA" ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Nationality:</label>
                                    <div class="col-md-7 display-inline">
                                        <select class="form-control" name="lrd_nationality" required>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if( $user_info->lrd_nationality == $key ): ?> selected <?php endif; ?>><?php echo e($country); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-30  display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Business Name:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ocb_name" value="<?php echo e($user_info->ocb_name); ?>" required/>
                                    </div>
                                </div>

                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">VAT: (If registered)</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="VAT_if_registered" value="<?php echo e($user_info->VAT_if_registered); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">House/Building Number:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_HBN" value="<?php echo e($user_info->ma_HBN); ?>" required/>
                                    </div>

                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Street/Road:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_street" value="<?php echo e($user_info->ma_street); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Town/City:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_town_or_city" value="<?php echo e($user_info->ma_town_or_city); ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-15 display-inline">
                                    <label class="col-form-label col-md-4 text-right color-black-light">Postcode:</label>
                                    <div class="col-md-7 display-inline">
                                        <input type="text" class="form-control" name="ma_postcode" value="<?php echo e($user_info->ma_postcode); ?>" />
                                    </div>
                                </div>

                            <?php endif; ?>
                                <div class="col-md-12 m-t-30">
                                    <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light">
                                        Save Changes
                                    </button>
                                </div>
                        </form>
                    </div>

                </div>

            </div>

            <div class="tab-pane p-3" id="tab_list_service" role="tabpanel">
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <span id="form_list_service_result"></span>
                        <form id="form_list_service">
                            <div class="col-md-10 m-t-10 display-inline text-center">
                                <label class="col-form-label text-center color-black-light" style="font-size: 1.25rem;">So We can list your services on our ‘Find Help’ pages, please provide the following information.</label>
                            </div>

                            <div class="col-md-12 m-t-30 display-inline">
                                <label class="col-form-label col-md-2 text-right color-black-light align-top" for="website">Website Address:</label>
                                <div class="col-md-9 display-inline">
                                    <input type="text" class="form-control" name="website" id="website" value="<?php echo e($user_info->website); ?>" />
                                    <small style="display: none;" id="website_error" class="text-danger">Must start with 'www' and no spaces.</small>
                                </div>
                                <label class="col-form-label offset-2 text-right color-black-light pl-3">
                                    (Consider using a custom landing page ...
                                    <a href="<?php echo e(url('settings/view_example_site')); ?>" target="_blank" class="color-black-light downloadable-tag">
                                        view this example
                                    </a>
                                    )
                                </label>
                            </div>

                            <div class="col-md-10 m-t-30 display-inline text-center">
                                <label class="col-form-label text-center color-black-light" style="font-size: 1.25rem;">Once you have entered the above information, click the below button for approval.</label>
                            </div>

                            <div class="col-md-11 m-t-30">
                                <button type="submit" class="btn bg-emerald text-white float-right waves-effect waves-light ml-1">
                                    &nbsp;
                                    Save Changes
                                    &nbsp;
                                </button>
                                <button
                                    id="list_service"
                                    class="btn
                                        <?php if($user_info->Approved_to_list == 'Ready'): ?>
                                        bg-light-grey
                                        <?php else: ?>
                                        bg-emerald
                                        <?php endif; ?>
                                        text-white float-right waves-effect waves-light"
                                    <?php if($user_info->Approved_to_list == 'Ready'): ?> disabled <?php endif; ?>>
                                    &nbsp;
                                    <?php if(is_null($user_info->Approved_to_list)): ?>
                                        List Service
                                    <?php elseif($user_info->Approved_to_list == 'Ready'): ?>
                                        Listing Request Made
                                    <?php elseif($user_info->Approved_to_list == 'Listed'): ?>
                                        Listing Active
                                    <?php endif; ?>
                                    &nbsp;
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
<!-- end row -->

<div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="form-group" id="article_detail">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $('#email').on('input',function() {
        if($('#user_type').val()=='citizen')
            return false;
        var str = "<?php echo e($freeEmailList); ?>";
        var freeEmails = str.split(',');
        var input_email = $('#email').val();
        for (let i = 0; i < freeEmails.length; i++) {
            if (input_email.indexOf(freeEmails[i]) < 0) {
                $('input[name=email]').css('box-shadow', '');
                $('input[name=email]').css('margin-bottom', '');
                $('#free_email_error').hide();
                continue;
            } else {
                $('input[name=email]').css('box-shadow', '0px 0px 4px red');
                $('input[name=email]').css('margin-bottom', '0px');
                $('#free_email_error').html('You cannot use a free email address.');
                $('#free_email_error').show();
                break;
            }
        }
    })

    $("#email").blur(function () {
        if ($('#free_email_error').css('display') != 'none') {
            return false;
        }

        if ($('#email').val() == '') {
            return false;
        }

        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#email').val())) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('settings.validation_email_duplication')); ?>",
                method: 'post',
                data: {
                    email: $('#email').val(),
                },
                success: function (result) {
                    if (result.status == false) {
                        Swal.fire({
                            title: "Click to Confirm",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3bc850",
                            cancelButtonColor: "#ec4561",
                            confirmButtonText: "Yes",
                            cancelButtonText: "No"
                        }).then(function (result) {
                            if (result.value) {

                                $.ajax({
                                    url: "<?php echo e(route('settings.auto_save_email')); ?>",
                                    method: "POST",
                                    data: {email: $('#email').val()},
                                    dataType: "json",
                                    success: function (data) {
                                        var html = '';

                                        if (data.errors) {
                                            html = '<div class="alert alert-convey-danger">';

                                            for (var count = 0; count < data.errors.length; count++) {
                                                html += '<p>' + data.errors[count] + '</p>';
                                            }

                                            html += '</div>';

                                            return false;
                                        }

                                        if (data.success) {
                                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                                        }

                                        $('#settings_form_result').html(html);
                                        setTimeout(function () {
                                            $('#settings_form_result').empty();
                                        }, 5000);

                                    }
                                })

                            }
                        });
                    } else {
                        $('input[name=email]').css('box-shadow', '0px 0px 4px red');
                        $('input[name=email]').css('margin-bottom', '0px');
                        $('#free_email_error').html('This email already exist.');
                        $('#free_email_error').show();
                        return false;
                    }
                }
            })

        }
    });

    $('#password').on('input',function(e) {
        var password = $('#password').val();

        if(password.length < 8) {
            $('input[name=password]').css('box-shadow', '0px 0px 4px red');
            $('input[name=password]').css('margin-bottom', '0px');
            $('#password_error').addClass('filled');
        } else {
            $('input[name=password]').css('box-shadow', '');
            $('input[name=password]').css('margin-bottom', '');
            $('#password_error').removeClass('filled');
        }
    })

    $("#password").keyup(function( event ) {

    }).keydown(function( event ) {
        var password = $('#password').val();
        var star_count = 0;

        for(var i = 0;  i < password.length; i++) {
            if(password.substr(i, 1) == '*') {
                star_count++;
            }
        }

        if(event.which == 8 || event.which == 46) {
            if(star_count == password.length || password.length == 15) {
                $('#password').val('');
            }
        }
    });

    $('#resend_email_btn').on('click',function (){
        $('.loading-show2').show();
        $('#resend_email_btn').prop('disabled',true);
        $.ajax({
            url:"<?php echo e(route('settings.resend_email')); ?>",
            method:"POST",
            data: { },
            dataType:"json",
            success:function(res){
                $('.loading-show2').hide();
                $('#resend_email_btn').prop('disabled',false);
                alertify.logPosition("top right");
                alertify.success(res.status);
            },
            error:function(){
                $('.loading-show2').hide();
                $('#resend_email_btn').prop('disabled',false);
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    })

    $(document).on('input','input[name=website]',function(){
        var website_url = $('input[name=website]').val();
        var url_array = website_url.split(' ');

        if (website_url.substr(0, 4) != 'www.' || url_array.length > 1) {
            $('input[name=website]').css('box-shadow', '0px 0px 4px red');
            $('input[name=website]').css('margin-bottom', '0px');

            $('#website_error').show();
        } else {
            $('input[name=website]').css('box-shadow', '');
            $('input[name=website]').css('margin-bottom', '');

            $('#website_error').hide();
        }
    })

    $('#update_account').on('submit', function(event) {
        event.preventDefault();

        account_settings_update();
    })

    function account_settings_update() {
        var password = $('#password').val();
        var error_detect = 0;
        var formElement = document.getElementById("update_account");
        var form_data = new FormData(formElement);

        if(password.length < 8) {
            error_detect = 1;
        } else {
            $('#password_error').removeClass('filled');
        }

        if(error_detect == 1) {
            return false;
        }

        $.ajax({
            url: "<?php echo e(route('settings.account_settings_update')); ?>",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';

                if (data.errors) {
                    html = '<div class="alert alert-convey-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }

                if (data.success) {
                    html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                }

                $('#settings_form_result').html(html);
                setTimeout(function () {
                    $('#settings_form_result').empty();
                }, 5000);
                window.scrollTo(0, 0);
            },
            error: function() {}
        })
    }

    $('#list_service').on('click', function(event) {
        event.preventDefault();

        if($('#list_service').text().indexOf('List Service') >= 0) {
            update_advisor_list_service('advisor_list_service');
        }
    })

    $('#form_list_service').on('submit', function(event) {
        event.preventDefault();

        update_advisor_list_service();
    })

    function update_advisor_list_service(update_flag = null) {
        var website_url = $('input[name=website]').val();
        var url_array = website_url.split(' ');
        var error_detect = 0;
        var formElement = document.getElementById("form_list_service");
        var form_data = new FormData(formElement);
        form_data.append('update_flag', update_flag);

        if (website_url.substr(0, 4) != 'www.' || url_array.length > 1) {
            $("html, body").animate({ scrollTop: 100 }, "slow");
            $('#website_error').show();
            error_detect = 1;
        } else {
            $('#website_error').hide();
        }

        if(error_detect == 1) {
            return false;
        }

        $.ajax({
            url: "<?php echo e(route('settings.update_advisor_list_service')); ?>",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-convey-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-convey-success">' + data.success + '</div>';

                    if(data.approve_status == 'Ready') {
                        $('#list_service').text('Listing Request Made');
                        $('#list_service').removeClass('bg-emerald');
                        $('#list_service').addClass('bg-light-grey');
                    } else if(data.approve_status == 'Listed') {
                        $('#list_service').text('Listing Active');
                        $('#list_service').removeClass('bg-light-grey');
                        $('#list_service').addClass('bg-emerald');
                    } else {
                        $('#list_service').text('List Service');
                        $('#list_service').removeClass('bg-light-grey');
                        $('#list_service').addClass('bg-emerald');
                        $("#list_service").removeAttr('disabled');
                    }

                }
                $('#form_list_service_result').html(html);
                setTimeout(function () {
                    $('#form_list_service_result').empty();
                }, 5000);
                window.scrollTo(0, 0);
            },
            error: function() {}
        })
    }

    $(document).on('input','input[name=company_no]',function(){
        var company_no = $('input[name=company_no]').val();
        if (!/^([A-Za-z0-9]{9})$/.test(company_no)) {
            $('input[name=company_no]').css('box-shadow', '0px 0px 4px red');
            $('input[name=company_no]').css('margin-bottom', '0px');

            $('#company_no_error').show();
        } else {
            $('input[name=company_no]').css('box-shadow', '');
            $('input[name=company_no]').css('margin-bottom', '');

            $('#company_no_error').hide();
        }
    })

    $('#sample_form').on('submit', function(event) {
        event.preventDefault();

        var business_type = $('select[name=business_type]').val();

        if(business_type == 'company') {
            var company_no = $('input[name=company_no]').val();

            if (!/^([A-Za-z0-9]{9})$/.test(company_no)) {
                $('input[name=company_no]').css('box-shadow', '0px 0px 4px red');
                $('input[name=company_no]').css('margin-bottom', '0px');
                $('#company_no_error').show();
                $("html, body").animate({ scrollTop: 0 }, "slow");

                return false;
            } else {
                $('input[name=company_no]').css('box-shadow', '');
                $('input[name=company_no]').css('margin-bottom', '');

                $('#company_no_error').hide();
            }
        }

        $.ajax({
            url: "<?php echo e(route('settings.account_details_update')); ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-convey-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                }
                $('#form_result').html(html);
                setTimeout(function () {
                    $('#form_result').empty();
                }, 5000);
                window.scrollTo(0, 0);

            }
        })
    });

    function view_guide_detail(input){
        $.ajax({
            url:"<?php echo e(route('advisors.get_guide_temp')); ?>",
            method:"POST",
            data: {
                item:input,
            },
            dataType:"json",
            success:function(html){
                $('#article_title').html('')
                $('#article_detail').html(html);
                $('.bs-example-modal-lg').modal('show');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-advisors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/virtual/vps-91c4dd/d/d2263f56e5/public_html/ca/resources/views/front/advisors/settings.blade.php ENDPATH**/ ?>