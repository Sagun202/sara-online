<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\VendorController;

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
 
 Route::get('/migrate',function(){
     Artisan::call('storage:link');
     dd('arrive');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/frontend.php';
Route::resource('vendor','VendorController');
