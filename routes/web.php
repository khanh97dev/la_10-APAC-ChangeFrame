<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

$pages = File::allFiles(app_path('Http/Controllers/Pages'));
foreach ($pages as $page) {
    if ($page->isFile()) {
        $uri = str_replace('Controller.php', '', str_replace('\\', '/', $page->getRelativePathname()));
        $nameSpace = str_replace( '/', '\\', 'App\Http\Controllers\Pages\\' . $uri);
        Route::get(str_replace('/-', '/', Str::kebab($uri)), $nameSpace . 'Controller@index');
    }
}
