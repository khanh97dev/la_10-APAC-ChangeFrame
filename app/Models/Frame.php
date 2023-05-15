<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frame extends Model
{
    use HasFactory;

    protected $table = 'frame';
    protected $guarded = ['_token'];

    public static function exampleData(): array
    {
        return [
            [
                'username' => 'yellow',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'red',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'blue',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'cyan',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'green',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'purple',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'orange',
                'image_id' => random_int(1, 3)
            ],
            [
                'username' => 'magenta',
                'image_id' => random_int(1, 3)
            ],
        ];
    }

    /**
     * Get the user that owns the Frame
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
