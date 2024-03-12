<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'guides';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'title'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
