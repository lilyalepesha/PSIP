<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $response = Car::query()
            ->with([
                'brand',
                'model',
                'generation',
                'guide',
                'images'
            ])
            ->orderBy('published_at', 'DESC')
            ->filter($request->all())
            ->paginate(20);

        return view('dashboard.cars.index', compact('response'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $car = Car::query()
            ->with([
                'brand',
                'model',
                'generation',
                'guide.guide',
                'images'
            ])
            ->firstWhere('id', '=', $id);

        return view('dashboard.cars.show', compact('car'));
    }
}
