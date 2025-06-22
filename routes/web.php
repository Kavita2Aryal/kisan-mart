<?php

use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

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

//replace require_once to require while testing

// Website
require_once('modules/website/auth.php');

// require_once('modules/website/web.php');

//admin
require_once('modules/auth.php');

require_once('modules/general.php');


require_once('modules/cms.php');

require_once('modules/build.php');

require_once('modules/addons.php');

require_once('modules/ecommerce.php');

Route::any('close-tab', function () { return "<script>window.close();</script>"; })->name('close.tab');



Route::fallback(function () { abort(404); });