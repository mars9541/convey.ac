@extends('layouts.master')

@section('content')
<div class="row">
<div class="col-sm-12">
    <div class="page-title-box">
        <div class="float-right">
            <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                <li class="breadcrumb-item active"><a href="#">Guide Manager</a></li>
            </ol>
        </div>
        <h4 class="page-title">Guide Manager</h4>
    </div>
</div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#business_section" role="tab" id="qa_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Business Section</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#advisors_section" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Advisors Section</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#hris_section" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">HRIS Section</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#terms_privacy" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Terms & Privacy</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#sample_email" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Others</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="business_section" role="tabpanel">
                    <form>
                        <input type="hidden" name="flag" value="getting_started_of_business">
                        <div class="form-group">
                            <label for="api_connect" class="col-form-label">Getting Started</label>
                            <textarea id="api_connect" name="content" class="summernote">{{App\Guide::where('flag','getting_started_of_business')->first()->content}}</textarea>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="api_connect_page_of_business">
                        <div class="form-group">
                            <label for="api_connect" class="col-form-label">API Connect Page</label>
                            <textarea id="api_connect" name="content" class="summernote">{{App\Guide::where('flag','api_connect_page_of_business')->first()->content}}</textarea>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="how_to_email_verify">
                        <div class="form-group">
                            <label for="email_verify" class="col-form-label">How to Email verify</label>
                            <textarea id="email_verify" name="content" class="summernote">{{App\Guide::where('flag','how_to_email_verify')->first()->content}}</textarea>
                        </div>
                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="how_to_record_upload">
                        <div class="form-group">
                            <label for="record_upload" class="col-form-label">How to Record Upload</label>
                            <textarea id="record_upload" name="content" class="summernote">{{App\Guide::where('flag','how_to_record_upload')->first()->content}}</textarea>
                        </div>
                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="how_to_first_search">
                        <div class="form-group">
                            <label for="first_search" class="col-form-label">How to First Search</label>
                            <textarea id="first_search" name="content" class="summernote">{{App\Guide::where('flag','how_to_first_search')->first()->content}}</textarea>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="how_to_referre_code">
                        <div class="form-group">
                            <label for="referre_code" class="col-form-label">How to Referre Code</label>
                            <div class="col-lg-12">
                                <textarea id="referre_code" name="content"class="summernote">{{App\Guide::where('flag','how_to_referre_code')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="branch_manager_of_business">
                        <div class="form-group">
                            <label for="referre_code" class="col-form-label">Branch Manager Guide</label>
                            <div class="col-lg-12">
                                <textarea id="referre_code" name="content"class="summernote">{{App\Guide::where('flag','branch_manager_of_business')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="branch_level_direct_conect_of_business">
                        <div class="form-group">
                            <label for="referre_code" class="col-form-label">Branch Level ‘Direct Connect’</label>
                            <div class="col-lg-12">
                                <textarea id="referre_code" name="content"class="summernote">{{App\Guide::where('flag','branch_level_direct_conect_of_business')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                </div>

                <div class="tab-pane p-3" id="advisors_section" role="tabpanel">
                    <form>
                        <input type="hidden" name="flag" value="getting_started_of_advisors">
                        <div class="form-group">
                            <label for="api_connect" class="col-form-label">Getting Started</label>
                            <textarea id="api_connect" name="content" class="summernote">{{App\Guide::where('flag','getting_started_of_advisors')->first()->content}}</textarea>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="direct_connect_page_of_advisors">
                        <div class="form-group">
                            <label class="col-form-label">Direct Connect</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','direct_connect_page_of_advisors')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="hris_connect_page_of_advisors">
                        <div class="form-group">
                            <label class="col-form-label">HRIS Connect</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','hris_connect_page_of_advisors')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="api_connect_page_of_advisors">
                        <div class="form-group">
                            <label  class="col-form-label">API Connect</label>
                            <div class="col-lg-12">
                                <textarea  name="content"class="summernote">{{App\Guide::where('flag','api_connect_page_of_advisors')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                    <form>
                        <input type="hidden" name="flag" value="branches_page_of_advisors">
                        <div class="form-group">
                            <label class="col-form-label">Branches</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','branches_page_of_advisors')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>

                    </form>
                </div>

                <div class="tab-pane p-3" id="hris_section" role="tabpanel">
                    <form>
                        <input type="hidden" name="flag" value="api_connect_page_of_hris">
                        <div class="form-group">
                            <label class="col-form-label">API Connect</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','api_connect_page_of_hris')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="integration_tips_page_of_hris">
                        <div class="form-group">
                            <label class="col-form-label">Integration Tips</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','integration_tips_page_of_hris')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="promotional_tips_page_of_hris">
                        <div class="form-group">
                            <label class="col-form-label">Promotional Tips</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','promotional_tips_page_of_hris')->first()->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane p-3" id="terms_privacy" role="tabpanel">
                    <form>
                        <input type="hidden" name="flag" value="confidentiality_agreement_advisors">
                        <div class="form-group">
                            <label class="col-form-label">Confidentiality agreement of Advisors</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','confidentiality_agreement_advisors')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="terms_and_conditions_advisors">
                        <div class="form-group">
                            <label class="col-form-label">Terms And Conditions of Advisors</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','terms_and_conditions_advisors')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="privacy_agreement_advisors">
                        <div class="form-group">
                            <label class="col-form-label">Privacy agreement of Advisors</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','privacy_agreement_advisors')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>

                    <form>
                        <input type="hidden" name="flag" value="confidentiality_agreement_business">
                        <div class="form-group">
                            <label class="col-form-label">Confidentiality agreement of Business</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','confidentiality_agreement_business')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="terms_and_conditions_business">
                        <div class="form-group">
                            <label class="col-form-label">Terms And Conditions of Business</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','terms_and_conditions_business')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="privacy_agreement_business">
                        <div class="form-group">
                            <label class="col-form-label">Privacy agreement of Business</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','privacy_agreement_business')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>

                    <form>
                        <input type="hidden" name="flag" value="confidentiality_agreement_hris">
                        <div class="form-group">
                            <label class="col-form-label">Confidentiality agreement of HRIS</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','confidentiality_agreement_hris')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="terms_and_conditions_hris">
                        <div class="form-group">
                            <label class="col-form-label">Terms And Conditions of HRIS</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','terms_and_conditions_hris')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="privacy_agreement_hris">
                        <div class="form-group">
                            <label class="col-form-label">Privacy agreement of HRIS</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','privacy_agreement_hris')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>

                    <form>
                        <input type="hidden" name="flag" value="confidentiality_agreement_citizen">
                        <div class="form-group">
                            <label class="col-form-label">Confidentiality agreement of Citizen</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','confidentiality_agreement_citizen')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="terms_and_conditions_citizen">
                        <div class="form-group">
                            <label class="col-form-label">Terms And Conditions of Citizen</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','terms_and_conditions_citizen')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="privacy_agreement_citizen">
                        <div class="form-group">
                            <label class="col-form-label">Privacy agreement of Citizen</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','privacy_agreement_citizen')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane p-3" id="sample_email" role="tabpanel">
                    <form>
                        <input type="hidden" name="flag" value="example_email">
                        <div class="form-group">
                            <label class="col-form-label">Sample Email</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','example_email')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="flag" value="default_record_types">
                        <div class="form-group">
                            <label class="col-form-label">Default Record Types</label>
                            <div class="col-lg-12">
                                <textarea name="content"class="summernote">{{App\Guide::where('flag','default_record_types')->first()->content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                Save & Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
<!-- end row -->



@endsection
@section('script')
<script>
    $('.summernote').summernote({
        height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                 // set focus to editable area after initializing summernote
    });
    $('form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('save_guide') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data)
            {
                alertify.logPosition("top right");
                alertify.error(data.success);
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    });

</script>
@endsection
