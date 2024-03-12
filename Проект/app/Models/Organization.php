<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'organizations';

    /**
     * @var string[]
     */
    protected $fillable = [
        'external_id',
        'title'
    ];
}
