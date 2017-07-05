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
Route::get('/ppc-project.html','Controller@getProject');
Route::get('/project-sale.html','Controller@getSale');
Route::get('/project-rent.html','Controller@getRent');
Route::get('/ppc-recruitment.html','Controller@getRecruitment');
Route::get('/ppc-hrpolicies.html','Controller@getPolicies');
Route::get('/ppc-recruitment/{id}-{slug}.html','Controller@getRecruitmentDetail');
Route::get('/ppc-hrpolicies/{id}-{slug}.html','Controller@getPoliciesDetail');
Route::get('/about-ppc/{id}-{slug}.html','Controller@getAboutDetail');

Route::get('/ppc-news-{id}.html','Controller@getNewsByCat');
Route::get('/login-page','Controller@GetLoginPage');
Route::post('/login-page',[
    'as'=>'post-login',
    'uses'=>'Controller@PostLoginPage'
]);
Route::get('/logout','Controller@logout');

Route::post('/ppc-contact.html',[
    'as'=>'post-contact',
    'uses'=>'Controller@postContact'
]);

Route::get('/about-ppc.html','Controller@getAbout');
Route::get('/ppc-news.html','Controller@getNews');
Route::get('/ppc-contact.html','Controller@getContact');
Route::get('/ppc-news/{id}-{slug}.html','Controller@newsdetail');
Route::get('/ppc-project/{id}-{slug}.html','Controller@ProjectDetail');
//|---------------------------------
Route::get('/404.html','Controller@notfound');
Route::get('/500.html','Controller@badinternal');
Route::get('/sitemap.xml','Controller@sitemap');
//|---------------------------------
Route::get('/ppc-post.html','PostController@getFormPost');
Route::post('/ppc-post.html',[
    'as'=>'post-form-post',
    'uses'=>'PostController@postFormPost'
]);
Route::get('/ppc-tinh/{id}','PostController@getTinh');
Route::get('/ppc-quan/{id}','PostController@getQuan');

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
	
	//country
    Route::get('/country', 'FilterController@Country');
    Route::get('/country-delete/{id}', 'FilterController@DeleteCountry');
    Route::post('/country-save', 'FilterController@SaveCountry');
    Route::get('/search-country', 'FilterController@SearchCountry');

    //Province
    Route::get('/province', 'FilterController@Province');
    Route::get('/province-delete/{id}', 'FilterController@DeleteProvince');
    Route::post('/province-save', 'FilterController@SaveProvince');
    Route::get('/search-province', 'FilterController@SearchProvince');

    //District
    Route::get('/district', 'FilterController@District');
    Route::get('/district-delete/{id}', 'FilterController@DeleteDistrict');
    Route::get('/search-district', 'FilterController@SearchDistrict');
    Route::post('/district-save', 'FilterController@SaveDistrict');
    Route::post('/get-province', 'FilterController@GetProvince');
    Route::post('/get-district', 'FilterController@GetDistrict');

    //contact
    Route::get('/contact', 'ContactController@Home');
    Route::get('/contact/{id}', 'ContactController@GetContact');
    Route::get('/contact-delete/{id}', 'ContactController@DeleteContact');
    Route::post('/contact-save', 'ContactController@SaveContact');

    //project
    Route::get('/project', 'PropertyController@Project');
    Route::get('/project-delete/{id}', 'PropertyController@DeleteProject');
    Route::post('/project-save', 'PropertyController@SaveProject');

    //property
    Route::get('/property', 'PropertyController@Property');
    Route::get('/property-delete/{id}', 'PropertyController@DeleteProperty');
    Route::get('/property/{id}', 'PropertyController@GetProperty');
    Route::post('/property-save', 'PropertyController@SaveProperty');
    Route::get('/property-image-delete/{id}-{id_image}', 'PropertyController@DeletePropertyImage');
});