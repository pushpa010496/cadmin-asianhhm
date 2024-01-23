<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\NewuserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SeopageController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventOrgController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\BookShelfController;
use App\Http\Controllers\CallenderController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\MediaPackController;
use App\Http\Controllers\TechSpaceController;
use App\Http\Controllers\TracklinkController;
use App\Http\Controllers\XmlpharseController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\DataexportController;
use App\Http\Controllers\FileuploadController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\WhitePaperController;
use App\Http\Controllers\TechnoTrendController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BannerNotifyController;
use App\Http\Controllers\ContributorsController;
use App\Http\Controllers\PressreleaseController;
use App\Http\Controllers\TargetMarketController;
use App\Http\Controllers\ClientAdvertsController;
use App\Http\Controllers\GlobalReportsController;
use App\Http\Controllers\AdvaisoryBoardController;
use App\Http\Controllers\IndustryReportController;
use App\Http\Controllers\ReportCategoryController;
use App\Http\Controllers\TargetAudienceController;
use App\Http\Controllers\AuthorguidelineController;
use App\Http\Controllers\ReaserchInsitesController;
use App\Http\Controllers\ClientemailblastController;
use App\Http\Controllers\EditorialarticleController;
use App\Http\Controllers\GoogleEdmreportsController;
use App\Http\Controllers\TrackreportExportController;
use App\Http\Controllers\GoogletrackreportsController;
use App\Http\Controllers\GoogleEnewsletterreportsController;

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

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', [HomeController::class,'main']);
	Route::get('/home', [HomeController::class,'index'])->name('home');
	Route::resource('role',RoleController::class);
	Route::resource('users',NewuserController::class);
	Route::resource('permit',PermissionController::class);
	
	Route::group(['middleware' => ['permission:settings']], function() {
	 Route::resource("/permissions", PermissionController::class); 
	});
	Route::group(['middleware' => ['permission:settings']], function() {
	 Route::resource("/roles", RoleController::class); 
	});
	
	 
	/* Category section Routes */
	/* Route occ */
	Route::group(['middleware' => ['permission:industrialupdates']], function() {
	Route::resource('editorialcategory',CategoryController::class);
	Route::get('editorialcategory/reactivate/{editorialcategory}',[CategoryController::class,'reactivate']);
	
	Route::resource('editorialarticle',EditorialarticleController::class);
	Route::get('editorialarticle/reactivate/{editorialarticle}',[EditorialarticleController::class,'reactivate']);
	Route::post('editorialarticle/metatag/{editorialarticle}',[EditorialarticleController::class,'metatag'])->name('editorialarticle.meta');
	
	Route::resource('issues',IssueController::class);
	Route::get('issue/reactivate/{issue}',[IssueController::class,'reactivate']);
	
	Route::resource('ebooks',EbookController::class);
	Route::get('ebook/reactivate/{ebook}',[EbookController::class,'reactivate']);
	Route::post('ebook/metatag/{ebook}',[EbookController::class,'metatag'])->name('ebook.meta');
	// Route::post('ebooks/update/{ebook}',[EbookController::class,'update')->name('ebook.update');
	
	Route::resource('clientadverts',ClientAdvertsController::class);
	Route::get('clientadverts/reactivate/{clientadvert}',[ClientAdvertsController::class,'reactivate']);
	Route::post('clientadverts/metatag/{clientadvert}',[ClientAdvertsController::class,'metatag'])->name('clientadverts.meta');
	
	Route::resource('authorguideline',AuthorguidelineController::class);
	Route::get('authorguideline/reactivate/{authorguideline}',[AuthorguidelineController::class,'reactivate']);
	Route::post('authorguideline/metatag/{authorguideline}',[AuthorguidelineController::class,'metatag'])->name('authorguideline.meta');
	
	Route::resource('advisorboard',AdvaisoryBoardController::class);
	Route::get('advisorboard/reactivate/{advisorboard}',[AdvaisoryBoardController::class,'reactivate']);
	Route::post('advisorboard/metatag/{advisorboard}',[AdvaisoryBoardController::class,'metatag'])->name('advisorboard.meta');
	
	Route::resource('testimonials',TestimonialController::class);
	Route::get('testimonial/reactivate/{testimonial}',[TestimonialController::class,'reactivate']);
	Route::post('testimonials/metatag/{testimonials}',[TestimonialController::class,'metatag'])->name('testimonials.meta');
	
	Route::resource('cmspages',CmsPageController::class);
	Route::get('cmspages/reactivate/{cmspage}',[CmsPageController::class,'reactivate']);
	Route::post('cmspages/metatag/{cmspage}',[CmsPageController::class,'metatag'])->name('cmspages.meta');
	
	Route::resource('callender',CallenderController::class);
	Route::get('callender/reactivate/{callender}',[CallenderController::class,'reactivate']);
	
	Route::resource('mediapack',MediaPackController::class);
	Route::get('mediapack/reactivate/{mediapack}',[MediaPackController::class,'reactivate']);
	
	Route::resource('contributors',ContributorsController::class);
	Route::get('contributors/reactivate/{contributors}',[ContributorsController::class,'reactivate']);
	
	});
	
	
	//Route::put('news1/{news1}', 'NewsController@update')->name('news1.update');

		Route::post('news/metatag/{id}',[NewsController::class,'metatag'])->name('news.meta');
		Route::get('news/reactivate/{id}',[NewsController::class,'reactivate']);
	/* Route occ End */
	/* Industrial Updates */
	Route::group(['middleware' => ['permission:industrialupdates']], function() {
		
		Route::resource('newsone',NewsController::class);
	
		Route::resource('pressrelease', PressreleaseController::class);
		Route::post('pressrelease/metatag/{id}',[PressreleaseController::class,'metatag'])->name('pressrelease.meta');
		Route::get('pressrelease/reactivate/{id}',[PressreleaseController::class,'reactivate']);
	
		Route::resource('events', EventController::class);
		Route::post('events/metatag/{id}',[EventController::class,'metatag'])->name('events.meta');
		Route::get('events/reactivate/{id}',[EventController::class,'reactivate']);
	
		Route::resource('reportcategories', ReportCategoryController::class);
		Route::post('reportcategory/metatag/{id}',[ReportCategoryController::class,'metatag'])->name('reportcategy.meta');
		Route::get('reportcategory/reactivate/{id}',[ReportCategoryController::class,'reactivate']);	
	});
	/* Industrial Updates End*/
	Route::group(['middleware' => ['permission:sliders']], function() { 
		Route::resource("/pages", PageController::class);
		Route::get('pages/reactivate/{id}',[PageController::class,'reactivate']);
	});
	
	Route::group(['middleware' => ['permission:sliders']], function() { 
		Route::resource("/sliders", SliderController::class);
	});
		Route::get('sliders/reactivate/{id}',[SliderController::class,'reactivate']);
		//Route::get('slidersactive',[SliderController::class,'slidersactive');
	
	
	Route::group(['middleware' => ['permission:banners']], function() { 
		 Route::resource("/banners", BannerController::class);
		Route::get('banners/reactivate/{id}',[BannerController::class,'reactivate']); 
		Route::resource("/positions", PositionController::class);
		Route::get('positions/reactivate/{id}',[PositionController::class,'reactivate']);
		Route::get('bannersactive',[BannerController::class,'bannersactive']);
	});
	
	/*Advertise Starts */
	Route::resource('print',PrintController::class);
	Route::get('print/reactivate/{id}',[PrintController::class,'reactivate']);
	Route::resource('online',OnlineController::class);
	Route::get('online/reactivate/{id}',[OnlineController::class,'reactivate']);
	Route::resource('targetmarket',TargetMarketController::class);
	Route::get('targetmarket/reactivate/{id}',[TargetMarketController::class,'reactivate']);
	Route::resource('targetaudience',TargetAudienceController::class);
	Route::get('targetaudience/reactivate/{id}',[TargetAudienceController::class,'reactivate']);
	Route::resource('terms',TermController::class);
	Route::get('terms/reactivate/{id}',[TermController::class,'reactivate']);
	Route::resource('techspec',TechSpaceController::class);
	Route::get('techspec/reactivate/{id}',[TechSpaceController::class,'reactivate']);
	Route::resource('advertisers',AdvertiserController::class);
	Route::get('advertisers/reactivate/{id}',[AdvertiserController::class,'reactivate']);
	/*Advertise Ends */
	
	/*Knowledgebank start*/
	Route::group(['middleware' => ['permission:industrialupdates']], function() {
		
	
		Route::resource('article',ArticleController::class);
		Route::get('article/reactivate/{id}',[ArticleController::class,'reactivate']);
		Route::post('article/metatag/{id}',[ArticleController::class,'metatag'])->name('article.meta');
		Route::resource('interview',InterviewController::class);
		Route::get('interview/reactivate/{id}',[InterviewController::class,'reactivate']);
		Route::post('interview/metatag/{id}',[InterviewController::class,'metatag'])->name('interview.meta');
		Route::resource('project',ProjectController::class);
		Route::get('project/reactivate/{project}',[ProjectController::class,'reactivate']);
		Route::post('project/metatag/{id}',[ProjectController::class,'metatag'])->name('project.meta');
	
		Route::resource('industryreport',IndustryReportController::class);
		Route::get('industryreport/reactivate/{industryreport}',[IndustryReportController::class,'reactivate']);
		Route::post('industryreport/metatag/{id}',[IndustryReportController::class,'metatag'])->name('industryreport.meta');
	
		Route::resource('bookshelf',BookShelfController::class);
		Route::get('bookshelf/reactivate/{bookshelf}',[BookShelfController::class,'reactivate']);
		Route::post('bookshelf/metatag/{id}',[BookShelfController::class,'metatag'])->name('bookshelf.meta');
		Route::resource('casestudies',CaseStudyController::class);
		Route::get('casestudies/reactivate/{id}',[CaseStudyController::class,'reactivate']);
		Route::post('casestudies/metatag/{id}',[CaseStudyController::class,'metatag'])->name('casestudies.meta');
	
		 
		Route::resource('whitepaper',WhitePaperController::class);
		Route::get('whitepaper/reactivate/{whitepaper}',[WhitePaperController::class,'reactivate']);
		Route::post('whitepaper/metatag/{id}',[WhitePaperController::class,'metatag'])->name('whitepaper.meta');
	});
	Route::resource('technotrends',TechnoTrendController::class);
	Route::get('technotrends/reactivate/{technotrend}',[TechnoTrendController::class,'reactivate']);
	Route::post('technotrends/metatag/{id}',[TechnoTrendController::class,'metatag'])->name('technotrends.meta');
	
	Route::resource('reaserchinsites',ReaserchInsitesController::class);
	Route::get('reaserchinsites/reactivate/{reaserchinsite}',[ReaserchInsitesController::class,'reactivate']);
	Route::post('reaserchinsites/metatag/{id}',[ReaserchInsitesController::class,'metatag'])->name('reaserchinsites.meta');
	
	Route::group(['middleware' => ['permission:reports']], function() { 
	Route::resource('reports',GlobalReportsController::class);
	});
	
	/*Knowledgebank End*/
	
	
	/*eNewsletters section*/
   Route::resource('e-newsletters', NewsletterController::class);
	// Route::group(['middleware' => ['permission:enewsletters']], function() { 
	
	// 	 });
	Route::get('e-newsletters/reactivate/{id}',[NewsletterController::class,'reactivate']);
	
	Route::group(['middleware' => ['permission:enewsletters']], function() { 
		Route::resource("clientemailblast", ClientemailblastController::class);
		Route::get('clientemailblast/reactivate/{id}',[ClientemailblastController::class,'reactivate']);
	});
	
	/*webinars section*/
	Route::group(['middleware' => ['permission:webinars']], function() {
		Route::resource('webinars',WebinarController::class);	
		Route::get('webinars/reactivate/{webinar}',[WebinarController::class,'reactivate']);
	});
	
	//seopage
	
	Route::group(['middleware' => ['permission:seopage']], function() { 
		Route::resource("seopage", SeopageController::class);
		 });
	Route::post('seopage/metatag/{id}',[SeopageController::class,'metatag'])->name('seopage.meta');
	
	/*Event organiser*/
	
		Route::resource("eventorganisers", EventOrgController::class);
	Route::get('eventorganisers/reactivate/{id}',[EventOrgController::class,'reactivate']);
	Route::post('eventorganisers/metatag/{id}',[EventOrgController::class,'metatag'])->name('eventorg.meta');
	
	Route::group(['middleware' => ['permission:dataexport']], function() { 
	
	Route::resource("dataexport", DataexportController::class);
	
	Route::post('/exportdata', [DataexportController::class,'exportdata'])->name('exportdata');
	
	});
	Route::group(['middleware' => ['permission:fileupload']], function() { 
	Route::resource("fileupload",FileuploadController::class);
	
	});
	/* Parsing */
	 //Route::resource('newswire','NewswireController');
	  Route::get('prnews',[XmlpharseController::class,'prnews']);
	  Route::get('businesswire',[XmlpharseController::class,'businesswire']);
	  Route::get('globalnews',[XmlpharseController::class,'globalnews']);
	  Route::get('indbwwires',[XmlpharseController::class,'indbwwires']);
	  Route::get('prnewsreport',[XmlpharseController::class,'prnewsreport']);
	  Route::get('businessreport',[XmlpharseController::class,'businesreport']);
	  Route::get('globalreport',[XmlpharseController::class,'globalreport']);
	
	  
	/* End Parsing */
	
	/* Client Token */
	
	 // Route::get('passwordgen',[NewuserController::class,'passwordgen');
	 Route::get("/usersinfo",[NewuserController::class,'usertoken'])->name('usersinfo');
	
	// Route::get('articleupdate',[ArticleController::class,'test');
	
	 Route::get('seoupdate',[SeopageController::class,'seoupdate']);
	
	 Route::group(['middleware' => ['permission:leads']], function() { 
		 Route::get('/promotionleads',[DataexportController::class,'promotionLeads']);
		 
		 Route::get('/leads/{promotion}',[DataexportController::class,'promotionleadslist']);
		 Route::get('/leads/forms/{promotion}',[DataexportController::class,'promotionformleadslist']);
		 Route::get('/leads/download/{promotion}',[DataexportController::class,'promotiondownloadleadslist']);
		 Route::get('/leads/webinars/{webinar}',[DataexportController::class,'promotionwebinars']);
		 Route::get('/leads/form/{promotion}',[DataexportController::class,'promotionForms']);
		 Route::get('/leads/subscribe/{promotion}',[DataexportController::class,'promotionsubscribe']);
	
	
	
	 });
	
	Route::get('banenrnotify',[BannerNotifyController::class,'index']);
	Route::get('slidernotify',[BannerNotifyController::class,'slider']);
	
	
	/*Google analytics for banners,edm,enewsletters*/
	
	
	 Route::get('/trackbanner', [GoogletrackreportsController::class,'trackreport'])->name('trackbanner');
	Route::resource('analyticaltrackreports',GoogletrackreportsController::class);
	
	Route::get('/trackedm', [GoogleEdmreportsController::class,'edmTrackreport'])->name('edm');
	Route::resource('analyticaledmreports',GoogleEdmreportsController::class);
	Route::get("/ajax-edm/{titleid}",[GoogleEdmreportsController::class,'ajaxedm']);
	
	Route::get('/trackenewsletter', [GoogleEnewsletterreportsController::class,'enewsTrackreport'])->name('enewsletters');
	Route::resource('analyticalenewsreports',GoogleEnewsletterreportsController::class);
	//Route::get("/ajax-edm/{titleid}",[GoogleEnewsletterreportsController::class,'ajaxedm');
	
	
	/*Track link generation*/
	
	Route::get('newlinkviews/{ttid}',[TracklinkController::class,'getview'])->name('newlinkview');
	
	Route::post('newlink',[TracklinkController::class,'Addnewlink'])->name('newlinkss');
	
	Route::resource('/tracklinkgen', TracklinkController::class);
	
	// Route::get('/companytracker', [TracklinkController::class,'companyUrl');
	// Route::get('/companytrackerupdate', [TracklinkController::class,'companyUrlUpdate');
	
	
	Route::get('/trackreport', [TracklinkController::class,'trackreport']);
	
	
	//Route::get('/gettitleinfo', [TracklinkController::class,'gettitleinfo');
	
	Route::get('excel', [TrackreportExportController::class,'downloadExcel'],function(){
	
	
	
	});
	Route::get('excel/{short_urlid}',[TrackreportExportController::class,'reportbyip'],function ($short_urlid) {
	 
	});
	
	Route::get('excelclientip/{short_urlid}',[TrackreportExportController::class,'reportbyclientip'],function ($short_urlid) {
	 
	});
	
	Route::get('title/{title_id}',[TrackreportExportController::class,'titlereport'],function ($title_id) {
	 
	});
	
	
	Route::get('excelbytitle/{titleid}',[TrackreportExportController::class,'reportbytitle'],function ($titleid) {
	 
	});
	
	Route::get('{short_urlid}',[TracklinkController::class,'geturlinfo'],function ($short_urlid) {
	 
	});
	
	Route::get('titlesinfo/{ttid}',[TracklinkController::class,'gettitleinfo']);
	
	Route::resource('testimonials',TestimonialController::class);
	Route::get('testimonial/reactivate/{testimonial}',[TestimonialController::class,'reactivate']);
	Route::post('testimonials/metatag/{testimonials}',[TestimonialController::class,'metatag'])->name('testimonials.meta');
	
	Route::post('sub-regions',[GoogletrackreportsController::class,'getSubRegions'])->name('get.sub-regions');
	
	Route::post('region-country',[GoogletrackreportsController::class,'getRegionCountry'])->name('get.region-country');
	
	});
