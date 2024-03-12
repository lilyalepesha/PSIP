<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideList extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'guide_lists';

    /**
     * @var string[]
     */
    protected $fillable = [
        'guide_id',
        'value'
    ];
}
