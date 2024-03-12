<?php

namespace App\Models;

use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;
use Revalto\ModelFilter\Traits\ModelFilterTrait;

class Car extends Model
{
    use HasFactory, /**Cacheable,*/ ModelFilterTrait;

    /**
     * @var string
     */
    protected $table = 'cars';

    /**
     * @var string[]
     */
    protected $fillable = [
        'external_id',
        'external_type',
        'title',
        'description',
        'location_name',
        'short_location_name',
        'version',
        'brand_id',
        'model_id',
        'generation_id',
        'user_id',
        'organization_id',
        'public_url',
        'published_at',
        'refreshed_at'
    ];

    /**
     * @return HasOne
     */
    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    /**
     * @return HasOne
     */
    public function model(): HasOne
    {
        return $this->hasOne(\App\Models\Model::class, 'id', 'model_id');
    }

    /**
     * @return HasOne
     */
    public function generation(): HasOne
    {
        return $this->hasOne(Generation::class, 'id', 'generation_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function organization(): HasOne
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    /**
     * @return HasMany
     */
    public function guide(): HasMany
    {
        return $this->hasMany(CarGuide::class, 'car_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class, 'car_id', 'id');
    }

    /**
     * @return string|null
     */
    public function getPriceAttribute(): ?string
    {
        $response = $this->guide->firstWhere('guide_id', '=', 46);

        return $response->value ?? null;
    }

    /**
     * @return mixed
     */
    public function getAvgPriceAttribute()
    {
        return Cache::remember('car:avg:' . $this->brand_id . ':' . $this->model_id . ':' . $this->generation_id, now()->addHour(), function () {
            return Car::query()
                ->join('car_guides', 'car_guides.car_id', '=', 'cars.id')
                ->where('generation_id', $this->generation_id)
                ->where('brand_id', $this->brand_id)
                ->where('model_id', $this->model_id)
                ->where('car_guides.guide_id', 46)
                ->avg('car_guides.value');
        });
    }
}
