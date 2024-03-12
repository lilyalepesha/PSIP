<?php

namespace App\Console\Commands;

use App\Enums\CarExternalTypeEnum;
use App\Enums\CarGuideType;
use App\Enums\UserTypeEnum;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarGuide;
use App\Models\CarImage;
use App\Models\Generation;
use App\Models\Guide;
use App\Models\Model;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = collect()
//            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data.json'))))
//            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data2.json'))))
//            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data3.json'))))
//            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data4.json'))))
//            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data5.json'))))
//            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data6.json'))))
            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/data7.json'))))
            ->merge(json_decode(file_get_contents(storage_path('app/public/firstload/dataend.json'))));

//        dd($response[0], $response[312]);
//
        $organizations = Organization::query()->get();
        $guide = Guide::query()->get();
//        $guideList = GuideList::query()->get();

        $brands = Brand::query()->get();
        $models = Model::query()->get();
        $generations = Generation::query()->get();

        $bar = $this->output->createProgressBar($response->count());

        foreach ($response->chunk(1000) as $responseChunk) {
            $carModels = [];
            $images = [];
            $propertiesLocal = [];

            foreach ($responseChunk as $carId => $car) {
                try {
                    DB::beginTransaction();

                    $organization = null;
//                if(Car::query()->where('external_id', '=', $car->id)->exists()) {
//                    continue;
//                }

                    if(!empty($car->organizationId)) {
                        $organization = $organizations->firstWhere('external_id', '=', $car->organizationId);

                        if(empty($organization)) {
                            $organization = Organization::query()
                                ->create([
                                    'title' => $car->organizationTitle,
                                    'external_id' => $car->organizationId
                                ]);

                            $organizations = Organization::query()->toBase()->get();
                        }
                    }

                    $properties = collect($car->properties);

                    $brandId = $brands->firstWhere('title', '=', $properties->firstWhere('name', '=', 'brand')->value);
                    $modelId = $models->firstWhere('title', '=', $properties->firstWhere('name', '=', 'model')->value);
                    $generation = $generations->firstWhere('external_id', '=', $car->metadata->generationId ?? null);

                    $carModel = (object)[
                        'id' => $carId + 1,
                        'external_id' => $car->id,
                        'external_type' => CarExternalTypeEnum::AV->value,
                        'title' => 'Автомобиль',
                        'description' => $car->description ?? null,
                        'location_name' => $car->locationName,
                        'short_location_name' => $car->shortLocationName,
                        'version' => $car->version,
                        'brand_id' => $brandId->id,
                        'model_id' => $modelId->id,
                        'generation_id' => $generation->id ?? null,
                        'user_id' => null,
                        'organization_id' => $organization?->id,
                        'public_url' => $car->publicUrl,
                        'published_at' => !empty($car->publishedAt) ? Carbon::parse($car->publishedAt)->format('Y-m-d H:i:s') : null,
                        'refreshed_at' => !empty($car->refreshedAt) ? Carbon::parse($car->refreshedAt)->format('Y-m-d H:i:s') : null
                    ];

                    $carModels[] = $carModel;

                    if(!empty($car->metadata->vinInfo)) {
                        $properties->add((object)[
                            'name' => 'vin.value',
                            'value' => $car->metadata->vinInfo->vin
                        ]);
                    }

                    if(!empty($car->metadata->vinInfo->checked)) {
                        $properties->add((object)[
                            'name' => 'vin.checked',
                            'value' => $car->metadata->vinInfo->checked
                        ]);
                    } else {
                        $properties->add((object)[
                            'name' => 'vin.checked',
                            'value' => null
                        ]);
                    }

                    if(!empty($car->metadata->vinInfo->checkedAt)) {
                        $properties->add((object)[
                            'name' => 'vin.checked_at',
                            'value' => $car->metadata->vinInfo->checkedAt
                        ]);
                    } else {
                        $properties->add((object)[
                            'name' => 'vin.checked_at',
                            'value' => null
                        ]);
                    }

                    $properties->add((object)[
                        'name' => 'external.brand_id',
                        'value' => $car->metadata->brandId
                    ]);

                    $properties->add((object)[
                        'name' => 'external.model_id',
                        'value' => $car->metadata->modelId
                    ]);

                    $properties->add((object)[
                        'name' => 'external.generation_id',
                        'value' => $car->metadata->generationId ?? null
                    ]);

                    foreach ($properties as $property) {
                        $thisGuide = $guide->firstWhere('key', '=', $property->name);

                        if(empty($thisGuide)) {
                            $thisGuide = Guide::query()
                                ->create([
                                    'title' => $property->name,
                                    'key' => $property->name,
                                ]);

                            $guide = Guide::query()->toBase()->get();
                        }

                        $propertiesLocal[] = [
                            'car_id' => $carModel->id,
                            'guide_id' => $thisGuide->id,
                            'type' => CarGuideType::GUIDE,
                            'value' => $property->value
                        ];
                    }

                    foreach ($car->photos as $photo) {
                        $images[] = [
                            'car_id' => $carModel->id,
                            'url' => $photo?->big?->url ?? $photo?->medium?->url ?? $photo?->small?->url
                        ];
                    }

                    $bar->advance();

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }

            if(!empty($carModels)) {
                foreach (array_chunk($carModels, 1000) as $chunk) {
//                    dd($chunk);
                    Car::query()->insert(array_map(fn ($res) => (array)$res, $chunk));
                }
            }

            if(!empty($images)) {
                foreach (array_chunk($images, 1000) as $chunk) {
                    CarImage::query()->insert($chunk);
                }
            }

            if(!empty($propertiesLocal)) {
                foreach (array_chunk($propertiesLocal, 1000) as $chunk) {
                    CarGuide::query()->insert($chunk);
                }
            }
        }

        $bar->finish();

        return self::SUCCESS;
    }
}
