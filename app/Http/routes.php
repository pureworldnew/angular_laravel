<?php

//Below only for Testing:
Route::group(['middleware' => ['web']], function () {
    Route::get('calcAdminFee', 'BookingController@calcAdminFee');
    Route::get('testuser', 'BookingController@testuser');
    Route::get('removeProductNew', 'BookingController@removeProductNew');
    Route::get('testEmail', 'BookingController@testEmail');
    Route::get('productIsFee/{bookingId}/{productId}', 'ProductController@productIsFee');
    Route::get('userHasAccess', 'BookingController@userHasAccess');
    Route::get('testProductId', 'ProductController@testProductId');
    Route::get('pruneSearches', 'SearchController@pruneSearches');
    Route::get('returnAmount', 'Admin\BookingController@returnAmount');

});

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routess
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('booking/klarnaConfirm', 'BookingController@klarnaConfirm');

    Route::get('api/search', 'SearchController@index');                     //todo: does this need logged in to only pull stock of the logged in user
    Route::get('api/paymentintent/{id}', 'BookingController@paymentIntent');                     //todo: does this need logged in to only pull stock of the logged in user
    Route::post('api/book', 'BookingController@make');
    Route::post('api/book/product', 'BookingController@addProduct');
    Route::post('api/timeTypes', 'TimetypeController@getTimeTypes'); //not done yet
    Route::get('api/products/{id}', 'ProductController@show');
    Route::get('api/getBookingProducts', 'ProductController@getBookingProducts');
    Route::post('api/fetchcart', [ 'before'=> 'csrf', 'uses' => 'CartController@fetchCart']);
    Route::get('api/getPrice',  'PriceController@getPrice');
    Route::get('api/productAvail', 'AvailabilityController@productAvail');
    Route::delete('api/booking/removeCartItem', 'BookingController@removeCartItem');
    Route::post('api/booking/updateProductQuantity', 'BookingController@updateProductQuantity');

    Route::get('getPrice/{id}/{startDateTime}/{endDateTime}/{quantity}',  'ProductController@getPrice');
    Route::post('booking/stripePayment', [
        'as' => 'booking.stripePayment', 'uses' => 'BookingController@stripePayment'
    ]);
    Route::get('/', 'HomeController@index');

    Route::auth();
    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
    Route::get('locale', 'BookingController@locale');

    Route::get('updateProductQuantity', 'BookingController@updateProductQuantityTemp');
    Route::post('availability/search', 'AvailabilityController@search');

    Route::get('admin', 'AdminController@index');
    Route::get('booking', 'BookingController@index');
    Route::post('booking', 'BookingController@index');
    Route::post('booking/empty-cart', 'CartController@emptyCart');
    Route::get('booking/edit/{bookingId}/product/{productId}', 'BookingController@editBooking');
    Route::get('booking/confirm', 'BookingController@confirm');
    Route::post('booking/confirm', 'BookingController@confirm');

    Route::get('manage', 'BookingController@manage');
    Route::post('manage', 'BookingController@manage');

    Route::get('booking/pay', 'BookingController@pay');
    Route::post('booking/pay', 'BookingController@pay');
    Route::post('booking/doPay', 'BookingController@doPay');

    Route::get('booking/stripe-error', 'BookingController@stripeError');
    Route::get('booking/confirmation', 'BookingController@confirmation');
    Route::post('booking/confirmation', 'BookingController@confirmation');

    Route::get('booking/cancel/{bookingId}/{token}', 'BookingController@cancel');
    Route::post('booking/removeProduct', 'BookingController@removeProduct');
    Route::delete('booking/removeProduct', 'BookingController@removeProduct');

    Route::post('booking/cancelBooking', 'BookingController@cancelBooking');


    Route::get('admin/resources', 'AdminController@resources');
    Route::get('admin/bookings', 'Admin\BookingController@index');
    Route::get('admin/picklist', 'Admin\BookingController@picklist');
    Route::post('admin/booking/refundProduct', 'Admin\BookingController@refundProduct');
    Route::post('admin/booking/cancel', 'Admin\BookingController@cancel');
    Route::post('admin/booking/credit', 'Admin\BookingController@credit');
    Route::post('admin/booking/activateProduct', 'Admin\BookingController@activateProduct');
    Route::post('admin/booking/registerPayment', 'Admin\BookingController@registerPayment');
    Route::post('admin/booking/unregisterPayment', 'Admin\BookingController@unregisterPayment');
    
    Route::post('admin/booking/returnAmount', 'Admin\BookingController@returnAmount');

    Route::get('admin/booking/{id}', 'Admin\BookingController@show');
    Route::post('admin/booking/activate', 'Admin\BookingController@activate');
    Route::post('admin/booking/activateSelectedProducts', 'Admin\BookingController@activateSelectedProducts');
    Route::post('admin/booking/refundSelectedProducts', 'Admin\BookingController@refundSelectedProducts');

    Route::get('admin/users', 'AdminController@users');
    Route::get('admin/users/invited/{email}/{centreId}/{token}', 'Admin\UserController@invited');
    Route::post('admin/users/invite', 'Admin\UserController@invite');

    Route::get('admin/reports', 'AdminController@reports');
    Route::get('admin/reports/customers', 'Admin\ReportController@customers');
    Route::get('admin/reports/{reportType}', 'AdminController@reportType');
    Route::get('admin/settings', 'AdminController@settings');
    Route::post('admin/settings', 'AdminController@store');
    Route::patch('admin/settings/{id}', 'CentreController@update');

    Route::delete('/admin/resources/products/delete-image', 'ProductController@deleteImage');
    Route::PATCH('/admin/resources/products/make-image-primary', 'ProductController@makeImagePrimary');

    Route::resource('admin/resources/products', 'ProductController');
    Route::resource('admin/resources/categories', 'CategoryController');
    Route::resource('admin/resources/tagwords', 'TagwordsController');
    /* php artisan route:list
        GET 	    /photo 	                index 	    photo.index
        GET 	    /photo/create 	        create 	    photo.create
        POST 	    /photo 	                store 	    photo.store
        GET 	    /photo/{photo} 	        show 	    photo.show
        GET 	    /photo/{photo}/edit 	edit 	    photo.edit
        PUT/PATCH 	/photo/{photo} 	        update 	    photo.update
        DELETE 	    /photo/{photo} 	        destroy 	photo.destroy

    */

    Route::post('admin/resources/products/add', ['as' => 'articles.update', 'uses' => 'ArticlesController@update'] );
    Route::get('articles/create', ['as' => 'articles.create', 'uses' => 'ArticlesController@create']);

    Route::get('booking/{slug}/{locale}', 'CentreController@selectCentre');
    Route::get('booking/{slug}', 'CentreController@selectCentre');

    Route::get('{urlSlug}/terms', 'KlarnaController@terms');
    
    /*
        This handles the user's booking functionalities.
    */
Route::get('/mLoginForm', 'Auth\AuthController@mLoginForm');
Route::get('/MRegister', 'Auth\AuthController@MRegistrationForm');
// manager invite validation 
Route::get('admin/users/minvited/{email}/{centreId}/{token}', 'Admin\UserController@minvited');
// front end user validation 
Route::get('/usignup', 'Auth\AuthController@usignup');
Route::get('/ulogin', 'Auth\AuthController@ulogin');
Route::post('/uloginsubmit', 'Auth\AuthController@uloginsubmit');
Route::get('/ulogout', 'Admin\UserController@ulogout');
Route::get('admin/users/uinvited/{email}/{centreId}/{token}', 'Admin\UserController@uinvited');
Route::get('/frontprofile', 'Admin\UserController@FrontProfile');
Route::post('/EditProfile', 'Admin\UserController@EditProfile');
## Admin login submit 
Route::post('/adminloginsubmit', 'Auth\AuthController@adminloginsubmit');

});


Route::get('/signup', 'UserController@UserSignup');


Route::group(['middleware' => ['booking']], function () {
     // 
     

});

