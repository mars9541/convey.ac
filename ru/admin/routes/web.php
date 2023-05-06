<?php
use App\Country;
use App\Market;
// use App\Signup_history;
use App\User;

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
Route::get('/', function () {
//dd('');
	if(Auth::check()){

		return redirect('home');
	}
    return view('auth.login');
});
Route::post('/login_user','Auth\LoginController@login')->name('login_user');

Route::get('/login_redirect/{email}', 'Auth\LoginController@login_redirect');



Route::group(['middleware' => ['auth']], function() {
	Route::get('home','HomeController@index');
	Route::get('settings','SettingsController@index');

    Route::get('signup_rule','SignupController@index');
    Route::post('signup_rule/email_types_list', 'SignupController@email_types_list');
    Route::post('signup_rule/email_type_save', 'SignupController@email_type_save');
    Route::get('signup_rule/email_type_delete/{id}', 'SignupController@email_type_delete');

	Route::get('account','AccountController@index');
	Route::post('get_business','AccountController@get_business')->name('get_business');
	Route::post('get_hris','AccountController@get_hris')->name('get_hris');
	Route::post('hris_approve','AccountController@hris_approve')->name('hris_approve');
    Route::post('hris_order_list','AccountController@hris_order_list')->name('hris_order_list');
    Route::post('hris_order_update','AccountController@hris_order_update')->name('hris_order_update');
	Route::post('get_consultants','AccountController@get_consultants')->name('get_consultants');
    Route::post('consultants_approve','AccountController@consultants_approve')->name('consultants_approve');
	Route::post('get_citizen','AccountController@get_citizen')->name('get_citizen');

    Route::get('authorize_withdraw','AuthorizeController@index')->name('authorize_withdraw');
    Route::post('get_withdraw_list','AuthorizeController@get_withdraw_list')->name('get_withdraw_list');
    Route::post('update_withdraw','AuthorizeController@update_withdraw')->name('update_withdraw');

	Route::get('article','ArticleController@index');
	Route::post('article_list','ArticleController@article_list')->name('article_list');
	Route::post('save_article','ArticleController@save_article')->name('save_article');
	Route::get('get_article/{id}','ArticleController@get_article');
	Route::get('delete_article/{id}','ArticleController@delete_article');

	Route::get('emails','EmailController@index');
	Route::post('save_email_temp','EmailController@save_email_temp')->name('save_email_temp');
	Route::post('email_temp_list','EmailController@email_temp_list')->name('email_temp_list');
	Route::get('get_email_temp/{id}','EmailController@get_email_temp');
	Route::post('add_group_email','EmailController@add_group_email')->name('add_group_email');
	Route::get('preview_email/{id}','MailController@preview_email')->name('preview_email');

	Route::post('sendhtmlemail','MailController@html_email')->name('send_html_email');

	Route::get('knowledge','KnowledgeController@index');
	Route::post('save_knowledge','KnowledgeController@save_knowledge')->name('save_knowledge');
	Route::post('knowledge_list','KnowledgeController@knowledge_list')->name('knowledge_list');
	Route::get('get_knowledge/{id}','KnowledgeController@get_knowledge');
	Route::get('delete_knowledge/{id}','KnowledgeController@delete_knowledge');


	Route::get('records','RecordsController@index');
	/////// search tab //////////
	Route::post('records/search', 'RecordsController@search');
	Route::post('records/get_record_version', 'RecordsController@get_record_version');

	////////monitor tab ////////////
	Route::post('records/RDB_temp_list', 'RecordsController@RDB_temp_list')->name('RDB_temp_list');
	Route::get('records/approve/{id}', 'RecordsController@approve')->name('approve');
	Route::get('records/remove/{id}', 'RecordsController@remove')->name('remove');
	///// flage rule tab /////////
	Route::post('records/flag_rules_list', 'RecordsController@flag_rules_list');
	Route::post('records/flag_rules_save', 'RecordsController@flag_rules_save');
	Route::get('records/flag_rule_delete/{id}', 'RecordsController@flag_rule_delete');
    ///// test data tab /////////
    Route::post('records/test_data_list', 'RecordsController@test_data_list');
    Route::post('records/test_data_save', 'RecordsController@test_data_save');
    Route::get('records/test_data_delete/{id}', 'RecordsController@test_data_delete');

	Route::get('guide','GuideController@index');
	Route::post('save_guide','GuideController@save_guide')->name('save_guide');
    Route::get('gallery','GuideController@gallery')->name('gallery');
    Route::post('gallery_list','GuideController@gallery_list')->name('gallery_list');
    Route::get('get_gallery/{id}','GuideController@get_gallery');
    Route::get('delete_gallery/{id}','GuideController@delete_gallery');
    Route::post('gallery_add','GuideController@gallery_add')->name('gallery_add');
    Route::post('gallery_update','GuideController@gallery_update')->name('gallery_update');

});

