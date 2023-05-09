<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    const DISK = 'images';

    protected $table = 'image';

    public static function exampleData(): array
    {
        return [
            [
                'key' => 'frame',
                'title' => 'CCNX',
                'src' => 'frames/ccnx.png'
            ],
            [
                'key' => 'frame',
                'title' => 'Ip Supply',
                'src' => 'frames/ip_supply.png'
            ],
            [
                'key' => 'frame',
                'title' => 'USA Network',
                'src' => 'frames/usa_network.png'
            ],
            [
                'key' => 'product',
                'title' => 'aironet-wireless',
                'src' => 'products/aironet-wireless.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'cable',
                'src' => 'products/cable.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'Cisco',
                'src' => 'products/Cisco.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'CiscoGlobal',
                'src' => 'products/CiscoGlobal.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'phone',
                'src' => 'products/phone.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'router',
                'src' => 'products/router.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'switch',
                'src' => 'products/switch.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'switch-2',
                'src' => 'products/switch-2.jpg'
            ],
            [
                'key' => 'product',
                'title' => 'Wireless',
                'src' => 'products/Wireless.jpg'
            ],
        ];
    }

    public function getSrcAttribute()
    {
        return Storage::disk(self::DISK)->url($this->attributes['src']);
    }

}
