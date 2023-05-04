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
        $path = str_replace('Controller.php', '', str_replace('\\', '/', $page->getRelativePathname()));
        $uri = str_replace('/-', '/', Str::kebab($path));
        $className = str_replace('/', '\\', 'App\Http\Controllers\Pages\\' . $path) . 'Controller';

        // CRUD page
        if (method_exists($className, 'add')) {
            Route::get($uri . '/add', $className . '@add');
        }
        if (method_exists($className, 'show')) {
            Route::get($uri . '/show/{id}', $className . '@show');
        }
        if (method_exists($className, 'edit')) {
            Route::get($uri . '/edit/{id}', $className . '@edit');
        }
        // CRUD API
        if (method_exists($className, 'create')) {
            Route::post($uri . '/create', $className . '@create');
        }
        if (method_exists($className, 'update')) {
            Route::put($uri . '/update/{id}', $className . '@update');
        }
        if (method_exists($className, 'delete')) {
            Route::delete($uri . '/delete/{id}', $className . '@delete');
        }
        Route::get($uri, $className . '@index');
    }
}
