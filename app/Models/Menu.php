<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const MENU_HEADER = "MENU";
    const MENU = [
        [
            'href' => 'test',
            'label' => 'school',
            'icon' => 'school',
            'caption' => 'quasar-caption',
        ]
    ];

    public static function getData()
    {
        return self::MENU;
    }

    public static function getHeader()
    {
        return self::MENU_HEADER;
    }
}
