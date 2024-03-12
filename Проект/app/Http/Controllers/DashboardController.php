<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
//        $cars = Car::query()
//            ->with([
//                'brand',
//                'model',
//                'generation',
//                'guide',
//            ])
//            ->orderBy('count', 'DESC')
//            ->groupBy(['generation_id'])
//            ->selectRaw('*, count(*) as count')
//            ->whereHas('guide', fn ($query) => $query
//                ->where('guide_id', 46)
//                ->where('value', '<', 3000)
//            )
//            ->whereHas('guide', fn ($query) => $query
//                ->where('guide_id', 4)
//                ->where('value', '>', 1994)
//            )
//            ->limit(50)
//            ->get();
//
////        dd($cars);
////
//        $cars->map(function (Car $car) {
////            $avgPrice = Car::query()
////                ->join('car_guides', 'car_guides.car_id', '=', 'cars.id')
////                ->where('generation_id', $car->generation_id)
////                ->where('brand_id', $car->brand_id)
////                ->where('model_id', $car->model_id)
////                ->where('car_guides.guide_id', 46)
////                ->avg('car_guides.value');
//
//            $car->avg_price = $car->getAvgPriceAttribute();
//
//            return $car;
//        });
//
//        dd($cars);

//        dd(
//            $cars->map(fn ($res) => $res->brand->title . ' ' . $res->model->title . ' ' . ($res->generation?->title ?? 'Нет поколения') . ' (' . $res->count . ') - ' . number_format($res->avg_price, 0, '.', ' ') . ' $.')
//                ->toArray()
//        );

        $cars = Car::query()->count();
        $organisations = User::query()->where('type', '=', UserTypeEnum::ORGANIZATION->value)->count();
        $users = User::query()->where('type', '=', UserTypeEnum::USER->value)->count();

        $topOrganisations = User::query()
            ->withCount('cars')
            ->orderByDesc('cars_count')
            ->limit(10)
            ->get()
            ->map(function (User $user) {
                $user->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

                return $user;
            });

        return view('dashboard.index', compact('cars', 'organisations', 'users', 'topOrganisations'));
    }
}
