<?php

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

Route::get('/', 'Controller@Home');
Route::get('language/{locale}', 'Controller@SetLanguage');
Route::get('/project','Controller@getProject');
Route::get('/project-sale','Controller@getSale');
Route::get('/project-rent','Controller@getRent');
Route::get('/ppc-recruitment','Controller@getRecruitment');
Route::get('/ppc-hrpolicies','Controller@getPolicies');


Route::get('/about','Controller@getAbout');
Route::get('/news','Controller@getNews');
Route::get('/contact','Controller@getContact');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------*/
Route::get('admin/log-in','UserController@GetLogIn');
Route::post('admin/log-in','UserController@PostLogIn');
Route::get('admin/log-out','UserController@LogOut');
Route::group(['prefix'=>'admin'],function (){
    Route::get('/home', 'UserController@Home');

    Route::get('/slide', 'SlideController@Home');
    Route::post('/slide-save', 'SlideController@SaveSlide');
    Route::get('/slide-xoa/{id}', 'SlideController@XoaSlide');

    Route::get('/video-home', 'VideoHomeController@Home');
    Route::post('/video-home-save', 'VideoHomeController@SaveVideo');
    Route::get('/video-home-xoa/{id}', 'VideoHomeController@XoaVideo');

    Route::get('/introduce-home', 'IntroduceController@Home');
    Route::get('/introduce/{id}', 'IntroduceController@GetIntroduce');
    Route::post('/introduce-save', 'IntroduceController@SaveIntroduce');

});