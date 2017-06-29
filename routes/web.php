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
Route::get('/projects.html','Controller@getProject');
Route::get('/project-sale.html','Controller@getSale');
Route::get('/project-rent.html','Controller@getRent');
Route::get('/ppc-recruitment.html','Controller@getRecruitment');
Route::get('/ppc-hrpolicies.html','Controller@getPolicies');


Route::get('/about-ppc.html','Controller@getAbout');
Route::get('/news.html','Controller@getNews');
Route::get('/ppc-contact.html','Controller@getContact');
Route::get('/news/{id}-{slug}.html','Controller@newsdetail');
//|---------------------------------
Route::get('/404.html','Controller@notfound');
Route::get('/500.html','Controller@badinternal');
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