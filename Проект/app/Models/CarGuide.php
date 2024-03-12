<?php

namespace App\Models;

use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CarGuide extends Model
{
    use HasFactory, Cacheable;

    /**
     * @var string
     */
    protected $table = 'car_guides';

    /**
     * @var array
     */
    protected $fillable = [
        'guide_id',
        'car_id',
        'type',
        'value'
    ];

    /**
     * @return HasOne
     */
    public function guide(): HasOne
    {
        return $this->hasOne(Guide::class, 'id', 'guide_id');
    }
}
