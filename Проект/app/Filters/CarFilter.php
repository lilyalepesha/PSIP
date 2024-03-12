<?php

namespace App\Filters;

use App\Models\CarGuide;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Revalto\ModelFilter\ModelFilter;

class CarFilter extends ModelFilter
{
    /**
     * @var array
     */
    protected array $replaceColumns = [
        'location' => 'short_location_name'
    ];

    /**
     * @var array
     */
    protected array $defaults = [
        'short_location_name' => self::COMPOSITION_LIKE,
        'brand_id' => self::COMPOSITION_EQUAL,
        'model_id' => self::COMPOSITION_EQUAL,
        'generation_id' => self::COMPOSITION_EQUAL,
    ];

    /**
     * @param array|null $price
     * @return void
     */
    public function price(?array $price)
    {
        $this->query->when(
            !empty($price),
            fn(Builder $query) => $query->whereIn(
                'id',
                fn(\Illuminate\Database\Query\Builder $subQuery) => $subQuery->select('car_id')
                    ->from('car_guides')
                    ->where('guide_id', '=', 46)
                    ->where(
                        fn($query) => $query->when(!empty($price['min']), fn($subQuery) => $subQuery->where('value', '>', (int)$price['min']))
                            ->when(!empty($price['max']), fn($subQuery) => $subQuery->where('value', '<', (int)$price['max']))
                    )
            )
        );
    }

    /**
     * Полный привод
     *
     * @param string|null $value
     * @return void
     */
    public function fullDrive(?string $value)
    {
        $value = filter_var($value ?? false, FILTER_VALIDATE_BOOLEAN);

        $this->query->when(
            $value,
            fn(Builder $query) => $query->whereIn(
                'id',
                fn(\Illuminate\Database\Query\Builder $subQuery) => $subQuery->select('car_id')
                    ->from('car_guides')
                    ->where('guide_id', '=', 42)
                    ->whereIn('value', [
                        'подключаемый полный привод',
                        'постоянный полный привод'
                    ])
            )
        );
    }
}
