<?php
use App\Country;
use App\Market;
// use App\Signup_history;
use App\User;
use App\Branch;
use App\Gallery;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::post('/login_user','Auth\LoginController@login')->name('login_user');
Route::get('/login_retrieval','Auth\ResetPasswordController@retrieval')->name('login_retrieval');
Route::post('email_verify','Auth\RegisterController@email_verify')->name('email_verify');
Route::post('code_verify','Auth\RegisterController@code_verify')->name('code_verify');
Route::post('/save_register','Auth\RegisterController@user_create')->name('save_register');
Route::post('get_guide_temp','Auth\RegisterController@get_guide_temp')->name('get_terms_temp');
Route::post('send_contact_message','Auth\RegisterController@send_contact_message')->name('send_contact_message');
Route::post('departure_evaluation_add','Auth\RegisterController@departure_evaluation_add')->name('departure_evaluation_add');
Route::get('/departure_form/{request_id}','Auth\RegisterController@departure_form')->name('departure_form');;
Route::get('/login_redirect/{id}', 'Auth\LoginController@login_redirect');
Route::get('/frontend_downloadable_file/{id}', 'Auth\RegisterController@frontend_downloadable_file');
Route::post('send_password','Auth\ResetPasswordController@send_password')->name('send_password');
Route::get('confirm_email/{token}','Auth\VerificationController@confirm_email');
Route::get('unlock_record/{token}','Auth\LoginController@unlock_record_redirect');
Route::get('credit_offer/{token}','Auth\LoginController@credit_offer_redirect');
Route::get('check_replied_ticket/{token}','Auth\LoginController@check_replied_ticket_redirect');
Route::get('/schedule','Schedule\ScheduleController@index');
Route::get('/home1', function () {
//	 dd(Auth::user()->email);
    $user_type = User::where('email', Auth::user()->email)->first();
    // dd($user_type);
    if($user_type->user_type=='business')
        return redirect('/business/home');
    if($user_type->user_type=='hris')
        return redirect('/hris/home');
    if($user_type->user_type=='advisors')
        return redirect('/advisors/home');
    if($user_type->user_type=='citizen')
        return redirect('/citizen/home');
});

Route::group(['middleware' => ['auth'],'prefix' => 'settings/', 'as' => 'settings.', 'namespace' => 'Front'], function() {
    Route::post('account_details_update','SettingsController@account_details_update')->name('account_details_update');
    Route::post('account_settings_update','SettingsController@account_settings_update')->name('account_settings_update');
    Route::post('update_hris_list_service','SettingsController@update_hris_list_service')->name('update_hris_list_service');
    Route::post('update_advisor_list_service','SettingsController@update_advisor_list_service')->name('update_advisor_list_service');
    Route::post('validation_email_duplication','SettingsController@validation_email_duplication')->name('validation_email_duplication');
    Route::post('auto_save_email','SettingsController@auto_save_email')->name('auto_save_email');
    Route::post('resend_email','SettingsController@resend_email')->name('resend_email');
    Route::post('kyc_document_update','SettingsController@kyc_document_update')->name('kyc_document_update');
    Route::get('getting_started_download/{id}','SettingsController@getting_started_download')->name('getting_started_download');

    Route::post('active_country', 'SettingsController@active_country')->name('active_country');
    Route::post('active_other_country', 'SettingsController@active_other_country')->name('active_other_country');
    Route::post('save_rate_record', 'SettingsController@save_rate_record')->name('save_rate_record');
    Route::get('view_example_site', 'SettingsController@view_example_site')->name('view_example_site');
});

Route::group(['middleware' => ['auth'], 'as' => 'contact.', 'namespace' => 'Front'], function() {
    Route::post('send_ticket','ContactController@send_ticket')->name('send_ticket');
    Route::post('ticket_list','ContactController@ticket_list')->name('ticket_list');
    Route::post('get_ticket','ContactController@get_ticket')->name('get_ticket');

});

Route::group(['middleware' => ['auth','advisors'],'prefix' => 'advisors/', 'as' => 'advisors.', 'namespace' => 'Front\Advisors'], function() {
    Route::get('home','HomeController@index');
    Route::get('contact', 'HomeController@contact_view')->name('contact');
    //// help ///
    Route::get('help','HomeController@help_view')->name('help');
    Route::post('get_guide_temp','HomeController@get_guide_temp')->name('get_guide_temp');
    Route::post('get_article','HomeController@get_article')->name('get_article');

    Route::get('settings','SettingsController@index');

    Route::get('country_access', 'SettingsController@country_access')->name('country_access');

    Route::get('getting-started','HomeController@getting_started')->name('getting-started');
    Route::get('getting_started_download/{id}','HomeController@getting_started_download')->name('getting_started_download');

    Route::get('search','SearchController@index');
    Route::post('record_search', 'SearchController@search')->name('record_search');
    Route::post('get_record_version', 'SearchController@get_record_version')->name('get_record_version');
    Route::post('request_record_unlock', 'SearchController@request_record_unlock')->name('request_record_unlock');
    Route::post('get_qa_type_info','SearchController@get_qa_type_info')->name('get_qa_type_info');

    Route::post('sent_request_add','SearchController@sent_request_add')->name('sent_request_add');
    Route::post('get_sent_request_history_list','SearchController@get_sent_request_history_list')->name('get_sent_request_history_list');

    //// search-credits /////
    Route::get('search-credits','Search_creditsController@index')->name('search-credits');
    Route::post('get_history','Search_creditsController@get_history')->name('search_credits');
    Route::post('buy_credits','Search_creditsController@buy_credits')->name('buy_credits');
    Route::post('paypal_buy_credits','Search_creditsController@paypal_buy_credits')->name('paypal_buy_credits');
    Route::post('get_purchase_amount','Search_creditsController@get_purchase_amount')->name('get_purchase_amount');
    Route::get('invoice_download/{id}','Search_creditsController@invoice_download')->name('invoice_download');
    Route::get('receipt_download/{id}','Search_creditsController@receipt_download')->name('receipt_download');

    ///// credit offer /////
    Route::get('credit_offer','Search_creditsController@credit_offer')->name('credit_offer');

    Route::get('invite','InviteController@index');
    Route::post('generate_universal_code', 'InviteController@generate_universal_code')->name('generate_universal_code');
    Route::post('get_unique_code','InviteController@get_unique_code')->name('get_unique_code');
    Route::post('save_unique_code','InviteController@save_unique_code')->name('save_unique_code');
    Route::post('withdraw_save','InviteController@withdraw_save')->name('withdraw_save');
    Route::post('add_paypal','InviteController@add_paypal')->name('add_paypal');
    Route::post('withdraw_request','InviteController@withdraw_request')->name('withdraw_request');
    Route::post('withdraw_his','InviteController@withdraw_his')->name('withdraw_his');
    Route::post('create_bank','InviteController@create_bank')->name('create_bank');

    Route::get('advice_note_download/{id}','InviteController@advice_note_download')->name('advice_note_download');
    Route::post('receive_his','InviteController@receive_his')->name('receive_his');
    Route::post('get_received_amount','InviteController@get_received_amount')->name('get_received_amount');

    Route::get('direct','DirectController@index');
    Route::get('hris','HrisController@index');
    Route::post('get_hris','HrisController@get_hris')->name('get_hris');
    Route::get('api','ApiController@index');
    Route::get('branches','BranchesController@index');

});

Route::group(['middleware' => ['auth', 'business'], 'prefix' => 'business/', 'as' => 'business.', 'namespace' => 'Front\Business'], function() {
    Route::get('home','HomeController@index');
    Route::get('contact', 'HomeController@contact_view')->name('contact');
    //// help ///
    Route::get('help','HomeController@help_view')->name('help');
    Route::post('get_guide_temp','HomeController@get_guide_temp')->name('get_guide_temp');
    Route::post('get_article','HomeController@get_article')->name('get_article');

    Route::get('settings','SettingsController@index')->name('settings');
    Route::post('logo_add','SettingsController@template_logo_add')->name('logo_add');


    Route::get('getting-started','HomeController@getting_started')->name('getting-started');
    Route::get('getting_started_download/{id}','HomeController@getting_started_download')->name('getting_started_download');

    ////// search /////
    Route::get('search','SearchController@index');
//	Route::get('search','Search_creditsController@credit_offer');
    Route::post('record_search', 'SearchController@search')->name('record_search');
    Route::post('get_record_version', 'SearchController@get_record_version')->name('get_record_version');
    Route::post('request_record_unlock', 'SearchController@request_record_unlock')->name('request_record_unlock');

    Route::post('sent_request_add','SearchController@sent_request_add')->name('sent_request_add');
    Route::post('get_sent_request_history_list','SearchController@get_sent_request_history_list')->name('get_sent_request_history_list');

    //// search-credits /////
    Route::get('search-credits','Search_creditsController@index')->name('search-credits');
    Route::post('get_history','Search_creditsController@get_history')->name('search_credits');
    Route::post('buy_credits','Search_creditsController@buy_credits')->name('buy_credits');
    Route::post('paypal_buy_credits','Search_creditsController@paypal_buy_credits')->name('paypal_buy_credits');
    Route::post('get_purchase_amount','Search_creditsController@get_purchase_amount')->name('get_purchase_amount');
    Route::get('invoice_download/{id}','Search_creditsController@invoice_download')->name('invoice_download');
    Route::get('receipt_download/{id}','Search_creditsController@receipt_download')->name('receipt_download');

    ///// credit offer /////
    Route::get('credit_offer','Search_creditsController@credit_offer')->name('credit_offer');


    Route::get('invite','InviteController@index');
    Route::post('generate_universal_code', 'InviteController@generate_universal_code')->name('generate_universal_code');
    Route::post('get_unique_code','InviteController@get_unique_code')->name('get_unique_code');
    Route::post('create_bank','InviteController@create_bank')->name('create_bank');
    Route::post('save_unique_code','InviteController@save_unique_code')->name('save_unique_code');
    Route::post('add_paypal','InviteController@add_paypal')->name('add_paypal');
    Route::post('withdraw_request','InviteController@withdraw_request')->name('withdraw_request');
    Route::post('withdraw_save','InviteController@withdraw_save')->name('withdraw_save');
    Route::post('withdraw_his','InviteController@withdraw_his')->name('withdraw_his');
    Route::get('advice_note_download/{id}','InviteController@advice_note_download')->name('advice_note_download');
    Route::post('receive_his','InviteController@receive_his')->name('receive_his');
    Route::post('get_received_amount','InviteController@get_received_amount')->name('get_received_amount');


    Route::get('hris','HrisController@index');
    Route::post('get_hris','HrisController@get_hris')->name('get_hris');

    Route::get('api','ApiController@index');
    //business_last_five_record
    Route::post('get_api_record_list','ApiController@get_api_record_list')->name('get_api_record_list');
    Route::get('get_api_record_info/{id}','ApiController@get_api_record_info')->name('get_api_record_info');

    Route::post('get_api_record_error_list','ApiController@get_api_record_error_list')->name('get_api_record_error_list');
    Route::get('del_api_record/{id}','ApiController@del_api_record')->name('del_api_record');
    /// branch
    Route::get('branches','BranchesController@index');
    Route::post('branch_list','BranchesController@branch_list')->name('branch_list');
    Route::post('validation_email_duplication','BranchesController@validation_email_duplication')->name('validation_email_duplication');
    Route::get('get_branch/{id}','BranchesController@get_branch');
    Route::get('delete_branch/{id}','BranchesController@delete_branch');
    Route::post('activate_branch_manager','BranchesController@activate_branch_manager')->name('activate_branch_manager');
    Route::post('activate_branch_direct_manager','BranchesController@activate_branch_direct_manager')->name('activate_branch_direct_manager');
    Route::post('branch_add','BranchesController@branch_add')->name('branch_add');
    Route::post('branch_update','BranchesController@branch_update')->name('branch_update');

    // direct-connect
    Route::get('direct','DirectController@index');
    // new record
    Route::post('get_employees','DirectController@get_employees')->name('get_employees');
    Route::post('get_record_types','DirectController@get_record_types')->name('get_record_types');
    Route::post('record_add','DirectController@record_add')->name('record_add');
    Route::post('clear_draft','DirectController@clear_draft')->name('clear_draft');
    Route::post('save_draft','DirectController@save_draft')->name('save_draft');
    Route::post('get_draft_data','DirectController@get_draft_data')->name('get_draft_data');
    // record_type
    Route::post('record_type_list','DirectController@record_type_list')->name('record_type_list');
    Route::post('record_type_mode_list','DirectController@record_type_mode_list')->name('record_type_mode_list');
    Route::post('get_qa_type_info','DirectController@get_qa_type_info')->name('get_qa_type_info');
    Route::post('get_current_question_info','DirectController@get_current_question_info')->name('get_current_question_info');
    Route::post('save_question','DirectController@save_question')->name('save_question');
    Route::get('delete_question/{id}','DirectController@delete_question');
    Route::get('get_record_type/{id}','DirectController@get_record_type');
    Route::post('visible_record_type','DirectController@visible_record_type')->name('visible_record_type');
    Route::get('delete_record_type/{id}','DirectController@delete_record_type');
    Route::post('record_type_add','DirectController@record_type_add')->name('record_type_add');

    Route::post('record_type_update','DirectController@record_type_update')->name('record_type_update');
    Route::get('order_up/{id}','DirectController@record_type_order_up');
    Route::get('order_down/{id}','DirectController@record_type_order_down');
    Route::get('recordTemplateDownload/{id}','DirectController@recordTemplateDownload');
    Route::get('recordHistoryDownload/{id}','DirectController@recordHistoryDownload');
    // employees
    Route::post('employee_list','DirectController@employee_list')->name('employee_list');
    Route::get('get_employee/{id}','DirectController@get_employee');
    Route::get('delete_employee/{id}','DirectController@delete_employee');
    Route::post('employee_add','DirectController@employee_add')->name('employee_add');
    Route::post('employee_update','DirectController@employee_update')->name('employee_update');
    // recordhistory
    Route::post('record_history_list','DirectController@record_history_list')->name('record_history_list');
    Route::get('get_record_history_content/{id}','DirectController@get_record_history_content')->name('get_record_history_content');

});

Route::get('branch','Front\Branch\SigninController@index');
Route::get('branch/login','Front\Branch\SigninController@index');

Route::get('branch/login_redirect/{id}', 'Front\Branch\SigninController@login_redirect');

Route::post('branch/login_user','Front\Branch\SigninController@login_user')->name('branch_login');

Route::group(['middleware' => ['branch'],'prefix' => 'branch/', 'as' => 'branch.', 'namespace' => 'Front\Branch'], function() {
    Route::get('logout','SigninController@logout');
    Route::get('search','SearchController@index')->name('search');
    Route::post('record_search', 'SearchController@search')->name('record_search');
    Route::post('get_record_version', 'SearchController@get_record_version')->name('get_record_version');
    Route::post('request_record_unlock', 'SearchController@request_record_unlock')->name('request_record_unlock');
    Route::post('get_qa_type_info','SearchController@get_qa_type_info')->name('get_qa_type_info');
    Route::post('save_rate_record','SearchController@save_rate_record')->name('save_rate_record');

    Route::get('direct','DirectController@index')->name('direct');
    // new record
    Route::post('get_employees','DirectController@get_employees')->name('get_employees');
    Route::post('get_record_types','DirectController@get_record_types')->name('get_record_types');
    Route::post('record_add','DirectController@record_add')->name('record_add');
    Route::post('clear_draft','DirectController@clear_draft')->name('clear_draft');
    Route::post('save_draft','DirectController@save_draft')->name('save_draft');
//	   	// record_type
//		Route::post('record_type_list','DirectController@record_type_list')->name('record_type_list');

    Route::get('recordTemplateDownload/{id}','DirectController@recordTemplateDownload');
    Route::get('recordHistoryDownload/{id}','DirectController@recordHistoryDownload');
//		Route::post('record_type_add','DirectController@record_type_add')->name('record_type_add');
//		Route::post('record_type_update','DirectController@record_type_update')->name('record_type_update');
    // employees
    Route::post('employee_list','DirectController@employee_list')->name('employee_list');
    Route::get('get_employee/{id}','DirectController@get_employee');
    Route::get('delete_employee/{id}','DirectController@delete_employee');
    Route::post('employee_add','DirectController@employee_add')->name('employee_add');
    Route::post('employee_update','DirectController@employee_update')->name('employee_update');
    // recordhistory
    Route::post('record_history_list','DirectController@record_history_list')->name('record_history_list');
    Route::get('get_record_history_content/{id}','DirectController@get_record_history_content')->name('get_record_history_content');

    Route::post('sent_request_add','SearchController@sent_request_add')->name('sent_request_add');
    Route::post('get_sent_request_history_list','SearchController@get_sent_request_history_list')->name('get_sent_request_history_list');
});


Route::group(['middleware' => ['auth','citizen'],'prefix' => 'citizen/', 'as' => 'citizen.', 'namespace' => 'Front\Citizen'], function() {
    Route::get('home', 'HomeController@index');
    Route::get('contact', 'HomeController@contact_view')->name('contact');
    Route::post('get_article', 'HomeController@get_article')->name('get_article');
    Route::get('settings', 'SettingsController@index');
    Route::post('account_details_update', 'SettingsController@account_details_update')->name('account_details_update');
    Route::post('account_settings_update', 'SettingsController@account_settings_update')->name('account_settings_update');
    Route::post('record_settings_update','SettingsController@record_settings_update')->name('record_settings_update');
    Route::post('generate_replacement_number', 'SettingsController@generate_replacement_number')->name('generate_replacement_number');
    Route::post('record_lock', 'SettingsController@record_lock')->name('record_lock');
    Route::post('auto_save_ni_number', 'SettingsController@auto_save_ni_number')->name('auto_save_ni_number');
    Route::get('last-record', 'RecordController@index');
    Route::get('record_list', 'RecordController@record_list');
    Route::post('get_record_list', 'RecordController@get_record_list')->name('get_record_list');
});


Route::group(['middleware' => ['auth','hris'],'prefix' => 'hris/', 'as' => 'hris.', 'namespace' => 'Front\Hris'], function() {
    Route::get('home','HomeController@index');
    Route::get('contact', 'HomeController@contact_view')->name('contact');
    //// help ///
    Route::get('help','HomeController@help_view')->name('help');
    Route::post('get_guide_temp','HomeController@get_guide_temp')->name('get_guide_temp');
    Route::post('get_article','HomeController@get_article')->name('get_article');
    Route::get('settings','SettingsController@index');

    Route::get('country_access', 'SettingsController@country_access')->name('country_access');

    Route::get('invite','InviteController@index');
    Route::post('generate_universal_code', 'InviteController@generate_universal_code')->name('generate_universal_code');
    Route::post('get_unique_code','InviteController@get_unique_code')->name('get_unique_code');
    Route::post('save_unique_code','InviteController@save_unique_code')->name('save_unique_code');
    Route::post('withdraw_save','InviteController@withdraw_save')->name('withdraw_save');
    Route::post('withdraw_his','InviteController@withdraw_his')->name('withdraw_his');
    Route::post('add_paypal','InviteController@add_paypal')->name('add_paypal');
    Route::post('withdraw_request','InviteController@withdraw_request')->name('withdraw_request');
    Route::get('advice_note_download/{id}','InviteController@advice_note_download')->name('advice_note_download');
    Route::post('receive_his','InviteController@receive_his')->name('receive_his');
    Route::post('get_received_amount','InviteController@get_received_amount')->name('get_received_amount');
    Route::post('create_bank','InviteController@create_bank')->name('create_bank');

    Route::get('api','ApiController@index');
    //business_last_five_record
    Route::post('get_api_record_list','ApiController@get_api_record_list')->name('get_api_record_list');
    Route::get('get_api_record_info/{id}','ApiController@get_api_record_info')->name('get_api_record_info');

    Route::post('get_api_record_error_list','ApiController@get_api_record_error_list')->name('get_api_record_error_list');
    Route::get('del_api_record/{id}','ApiController@del_api_record')->name('del_api_record');

    Route::get('integration','IntegrationController@index');
    Route::get('promotional','PromotionalController@index');
    Route::post('get_hris','PromotionalController@get_hris')->name('get_hris');

});

Route::group(['middleware' => ['auth'],'prefix' => 'help/', 'as' => 'help.', 'namespace' => 'Front'], function() {
    Route::post('get_advisors','HelpController@get_advisors')->name('get_advisors');
});


Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
Route::post('test_paypal','PayPalController@test_paypal')->name('test_paypal');

Route::get('/',function(){

    $country = Country::all();

    return view('front.index', compact('country'));
});

Route::get('/benefits',function(){

    $country = Country::all();

    return view('front.benefits', compact('country'));
});

Route::get('/price',function(){

    $country = Country::all();

    return view('front.price', compact('country'));
});

Route::get('/secure',function(){

    $country = Country::all();

    return view('front.secure', compact('country'));
});

Route::get('/upgrade',function(){

    $country = Country::all();

    return view('front.upgrade', compact('country'));
});

Route::get('/more',function(){

    $gallery_list = Gallery::all();

    foreach ($gallery_list as $info) {
        $text = $info['gallery_text'];
        $text = explode("lumo=35000&quot;\">", $text);
        if(isset($text[1])) {
            $sub_text = substr($text[1], 0, 250);
            $sub_text = explode("</", $sub_text);

            if(isset($sub_text[0])) {
                $info['gallery_text'] = $sub_text[0];
            } else {
                $info['gallery_text'] = $sub_text;
            }

        }

    }

    return view('front.more', compact('gallery_list'));
});

Route::get('more/{id}','Auth\RegisterController@more')->name('more');

Route::get('/brand',function(){

    $country = Country::all();

    return view('front.brand', compact('country'));
});

Route::get('/press',function(){

    $country = Country::all();

    return view('front.press', compact('country'));
});

Route::get('/getintouch',function(){

    $country = Country::all();

    return view('front.getintouch', compact('country'));
});
