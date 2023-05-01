<?php

use Illuminate\Support\Facades\File;

$pages = File::allFiles(app_path('Http/Controllers/Pages'));
foreach ($pages as $page) {
    if ($page->isFile()) {
        $path = str_replace('Controller.php', '', str_replace('\\', '/', $page->getRelativePathname()));
        $nameSpace = str_replace( '/', '\\', 'App\Http\Controllers\Pages\\' . $path);
        Route::get(Str::kebab($uri), $nameSpace . 'Controller@index');
    }
}
