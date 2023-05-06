<?php $__env->startSection('content'); ?>
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Press & Media</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="bussiness-tab-accordion">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Background</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="About-tab">
                            <div class="padding-top-middle"></div>
                            <p>Conveyable Employment Records are digital files that CONVEY from one employer to the next allowing employees to retain a history of their work accomplishments even when they change employers.<br><br>All Conveyable Records are stored securely in the CONVEY Databank which is a neutrally positioned centralised resource accessible on a permission only basis by employees, employers and 3rd party approved providers. This level of neutrality allows businesses both large and small to establish secure connections to the CONVEY Databank in order to store and access employee records.</p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="Background-tab">
                            <div class="padding-top-middle"></div>
                            <p>CONVEY was founded by Clive Lambert, who in 2019 noticed how a large amount of information contained within employment records was not being utilised to its full potential because of the way in which it was being stored. <br><br> CONVEY works as a stand alone product, but also integrates with many HR/recruitment software providers who recognise the benefits of conveyability which they want to bring to their own business uses.</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="padding-top-middle"></div>
                            <p> For press and media enquiries, please forward all communications to: <br><br> press@convey.ac</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="business-faq">

                        <div class="panel-group" id="accordion" role="tablist">

                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                            Download Logo Files
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Please download our logos from here, our brand page in the footer of the website will outline how to utilise the logos within our brand guidelines.
                                        <br><br>
                                        <a href="<?php echo e(url('frontend_downloadable_file/press_logo')); ?>" class="color-black-light downloadable-tag">DOWNLOAD LOGOS<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                            Download Screen Shots
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Please download our website screenshots from here.
                                        <br><br>
                                        <a href="<?php echo e(url('frontend_downloadable_file/press_screen_shot')); ?>" class="color-black-light downloadable-tag">DOWNLOAD IMAGES<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                            Download Article Header Images
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Please download our article header images from here.
                                        <br><br>
                                        <a href="<?php echo e(url('frontend_downloadable_file/press_header_images')); ?>" class="color-black-light downloadable-tag">DOWNLOAD IMAGES<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="business-cta-2x">
        <div class="business-cta-2-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="business-cta-left-2">
                            <h2>A Quantum Leap Forward ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="<?php echo e(route('register')); ?>" class=" btn bussiness-btn-larg">UPGRADE NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/virtual/vps-91c4dd/d/d2263f56e5/public_html/ie/resources/views/front/press.blade.php ENDPATH**/ ?>