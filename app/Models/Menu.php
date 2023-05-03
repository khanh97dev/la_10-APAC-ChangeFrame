<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const MENU_HEADER = "Laravel";
    const MENU = [
        [
            'href' => '/',
            'label' => 'Home',
            'icon' => 'home',
            'caption' => 'Go to home',
            'active' => false
        ],
        [
            'href' => '/example',
            'label' => 'Example',
            'icon' => 'toc',
            'caption' => 'example for datatable',
            'active' => false
        ],
        [
            'href' => '/table',
            'label' => 'Table',
            'icon' => 'list_alt',
            'caption' => 'list',
            'active' => false
        ],
    ];

    public static function getData()
    {
        $menu = self::MENU;
        foreach ($menu as $key => $item) {
            $path = parse_url(url()->current(), PHP_URL_PATH);
            if ($path === $item['href']) {
                $menu[$key]['active'] = true;
            }
        }
        return $menu;
    }
    public static function getHeader()
    {
        return self::MENU_HEADER;
    }
}
