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
Route::get('/ppc-recruitment-detail/{id}-{slug}.html','Controller@getRecruitmentDetail');
Route::get('/hr-policies-detail/{id}-{slug}.html','Controller@getPoliciesDetail');


Route::get('/about-ppc.html','Controller@getAbout');
Route::get('/ppc-news.html','Controller@getNews');
Route::get('/ppc-contact.html','Controller@getContact');
Route::get('/ppc-news/{id}-{slug}.html','Controller@newsdetail');


//|---------------------------------
Route::get('/404.html','Controller@notfound');
Route::get('/500.html','Controller@badinternal');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------*/
//admin
Route::get('admin/log-in','UserController@GetLogIn');
Route::post('admin/log-in','UserController@PostLogIn');
Route::get('admin/log-out','UserController@LogOut');
Route::group(['prefix'=>'admin'],function (){
    Route::get('/home', 'UserController@Home');
    //slider
    Route::get('/slide', 'SlideController@Home');
    Route::post('/slide-save', 'SlideController@SaveSlide');
    Route::get('/slide-xoa/{id}', 'SlideController@XoaSlide');
//Video home
    Route::get('/video-home', 'VideoHomeController@Home');
    Route::post('/video-home-save', 'VideoHomeController@SaveVideo');
    Route::get('/video-home-xoa/{id}', 'VideoHomeController@XoaVideo');
//introduce
    Route::get('/introduce-home', 'IntroduceController@Home');
    Route::get('/introduce/{id}', 'IntroduceController@GetIntroduce');
    Route::post('/introduce-save', 'IntroduceController@SaveIntroduce');
//category news
    Route::get('/category-home', 'NewsController@CategoryHome');
    Route::post('/category-save', 'NewsController@CategorySave');
//news
    Route::get('/news-home', 'NewsController@NewsHome');
    Route::get('/news/{id}', 'NewsController@GetNews');
    Route::get('/news-delete/{id}', 'NewsController@DeleteNews');
    Route::post('/news-save', 'NewsController@SaveNews');
//gallery news
    Route::get('/news-gallery-home', 'NewsController@NewsGalleryHome');
    Route::get('/news-gallery/{id}', 'NewsController@GetNewsGallery');
    Route::post('/news-gallery-save', 'NewsController@SaveNewsGallery');
//gallery image news
    Route::get('/news-gallery-image/{id}', 'NewsController@NewsGalleryImageHome');
    Route::get('/news-gallery-image-delete/{idnews}-{id}', 'NewsController@DeleteGalleryImage');
    Route::post('/news-gallery-image-save','NewsController@SaveNewsGalleryImage');
//gallery video
    Route::get('/gallery-video', 'NewsController@GalleryVideoHome');
    Route::get('/gallery-video-delete/{id}', 'NewsController@DeleteGalleryVideo');
    Route::post('/gallery-video-save','NewsController@SaveGalleryVideo');
    //recruitment
    Route::get('/recruitment', 'RecruitmentController@RecruitmentHome');
    Route::get('/recruitment/{id}', 'RecruitmentController@GetRecruitment');
    Route::get('/recruitment-delete/{id}', 'RecruitmentController@DeleteRecruitment');
    Route::post('/recruitment-save','RecruitmentController@SaveRecruitment');

    //term
    Route::get('/term', 'TermController@Home');
    Route::get('/term/{id}', 'TermController@GetTerm');
    Route::post('/term-save','TermController@SaveTerm');
//partners
    Route::get('/partners', 'TermController@PartnersHome');
    Route::post('/partners-save','TermController@SavePartners');
    Route::get('/partners-delete/{id}','TermController@DeletePartners');

    //system config
    Route::get('/system-config', 'ConfigController@Home');
    Route::post('/config-save', 'ConfigController@SaveConfig');
});