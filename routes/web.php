<?php
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {

    if($request->has('magnet_id')){
      return view('welcome-download')->with([
        'magnet' => \App\Magnet::findOrFail($request->magnet_id)
      ]);
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/how-it-works',function(){
  return view('how-it-works');
});
Route::get('/privacy',function(){
  return view('privacy');
});
Route::get('/pricing',function(){
  return view('pricing');
});
