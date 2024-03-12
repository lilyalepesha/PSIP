<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'car_images';

    /**
     * @var string[]
     */
    protected $fillable = [
        'car_id',
        'url'
    ];
}
