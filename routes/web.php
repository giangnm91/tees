<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, x-prototype-version, X-Requested-With');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('auth/login', ['uses' => 'Auth\AuthCtrl@getLogin']);
Route::post('auth/login', ['uses' => 'Auth\AuthCtrl@postLogin']);
Route::get('auth/logout', ['uses' => 'Auth\AuthCtrl@getLogout']);

Route::group(['middleware' => ['auth','csrf']], function()
{
	View::composer(['layout.backend', 'layout.angular'], function ($view) {
        $view->with('NavbarHeader', \App\Http\Models\Backend\Category::renderMenu());
    });

	Route::group(['prefix' => 'article', 'namespace' => 'Article'],function(){
		Route::get('/add', [
		    'as' => 'add_article', 'uses' => 'ArticleCtrl@getAddArticle'
		]);
		Route::get('/', ['uses' => 'ArticleCtrl@getAddArticle'])->name('article');
	});

	Route::group(['prefix' => 'system', 'namespace' => 'System'], function(){
		Route::get('/menu', ['uses' => 'MenuCtrl@getIndex'])->name('system_menu');
		Route::post('/menu', ['uses' => 'MenuCtrl@Add'])->name('add_menu');
		Route::put('/menu', ['uses' => 'MenuCtrl@SavePosition'])->name('save_menu');
		Route::delete('/menu/{category_id}',['uses' =>'MenuCtrl@Delete'])->name('delete_menu');
		Route::get('/', ['uses' => 'MenuCtrl@getIndex'])->name('system');
	});

	Route::group(['prefix' => 'order', 'namespace' => 'Order'], function(){
		Route::post('/', ['uses' => 'OrderCtrl@getIndex'])->name('order_list');
		Route::get('/add', ['uses' => 'OrderCtrl@AddOrder'])->name('add_order');
		Route::get('/findUser/{user_id}', ['uses' => '\App\Http\Models\Backend\User@FindUser']);
		Route::post('/place-order', ['uses' => 'OrderCtrl@PlaceOrder']);
	});

	Route::get('/app', function()
    {
        return view('layout.angular');
    });
	Route::get('/', ['uses' => 'Main\DashboardCtrl@getIndex'])->name('home_route');
});

//Auth::routes();
Route::get('/home', 'Main\DashboardCtrl@getIndex');
