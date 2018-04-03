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
        $view->with('NavbarHeader', \App\Http\Models\Backend\Menu::renderMenu());
    });

	Route::group(['prefix' => 'category', 'namespace' => 'Category'], function(){
		Route::get('/', ['uses' => 'CategoryCtrl@getIndex'])->name('category');
		Route::get('/list', ['uses' => 'CategoryCtrl@getIndex'])->name('category');
		Route::post('/', ['uses' => 'CategoryCtrl@Add'])->name('add_category');
		Route::delete('/{category_id}',['uses' =>'CategoryCtrl@Delete'])->name('delete_category');
	});

	Route::group(['prefix' => 'product', 'namespace' => 'Product'], function(){
		//Route::get('/', ['uses' => 'ProductCtrl@postIndex'])->name('product');
		Route::get('/', ['uses' => 'ProductCtrl@getIndex'])->name('product');
		Route::delete('/', ['uses' => 'ProductCtrl@delete'])->name('delete_product');
		Route::post('/import-excel', ['uses' => 'ProductCtrl@postImportExcel'])->name('import_excel');
		Route::post('/preview-excel', ['uses' => 'ProductCtrl@postPreviewExcel'])->name('preview_excel');
		Route::post('/list', ['uses' => 'ProductCtrl@postList'])->name('post_list_product');
		Route::get('/find-product', ['uses' => 'ProductCtrl@getFindProduct'])->name('find_product');
		Route::post('/add-or-update-product', ['uses' => 'ProductCtrl@postAddOrUpdateProduct'])->name('post_add_update_product');
		Route::get('/add', ['uses' => 'ProductCtrl@AddProduct'])->name('add_product');
		//Route::post('/place-order', ['uses' => 'OrderCtrl@PlaceOrder']);
	});

	Route::get('/app', function()
    {
        return view('layout.angular');
    });
	Route::get('/', ['uses' => 'Main\DashboardCtrl@getIndex'])->name('home_route');
});

//Auth::routes();
Route::get('/home', 'Main\DashboardCtrl@getIndex');
