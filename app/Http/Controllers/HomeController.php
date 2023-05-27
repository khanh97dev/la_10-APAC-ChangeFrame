<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    private function getRoutes(): array
    {
        $namespace = '\App\Http\Controllers\Pages';
        $classes = [];

        $namespace = trim($namespace, '\\');
        $namespace = str_replace('\\', '\\\\', $namespace); // Escape backslashes for regex

        $pattern = "/^{$namespace}\\\\(.+)$/i";

        $classes = collect(get_declared_classes())
            ->filter(function ($class) use ($pattern) {
                return preg_match($pattern, $class);
            })
            ->map(function ($class) {
                return new \ReflectionClass($class);
            });
        $pages = $classes->map(function (\ReflectionClass $class) {
            $data = [];

            if ($class->hasMethod('index')) {
                $data['page_name'] = str_replace('Controller', '', class_basename($class->name));
                $data['action'] = $class->name . '@index';
            }

            return [
                'is_page' => $class->hasMethod('index'),
                'data' => $data
            ];
        })->filter(function ($class) {
            return $class['is_page'];
        });

        if ($pages->count()) {
            $routes = Route::getRoutes();
            $pages = $pages->toArray();
            // Merge URI to $pages
            collect($routes)->each(function(\Illuminate\Routing\Route $route) use(&$pages) {
                foreach ($pages as $keyPage => $page) {
                    $routeAction = $route->getAction('controller');
                    if ($routeAction === $page['data']['action']) {
                        $pages[$keyPage]['data']['uri'] = $route->uri();
                        break;
                    }
                }
            });
            return $pages;
        } else {
            return [];
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'pages' => $this->getRoutes()
        ]);
    }
}
