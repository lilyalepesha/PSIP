<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_balances';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'value',
        'status',
        'comment',
        'type_of_space',
        'type_of_space_item_id'
    ];
}
