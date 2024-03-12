<?php

namespace App\Console\Commands\Scraping;

use App\Actions\MakeCarByAvCarsAction;
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
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AVScrapingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:av';

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
     * @throws GuzzleException
     */
    public function handle(): int
    {
//        $page = Cache::get('av:page', 1);
        $page = 1;

        dump($page);
        $response = (new Client())->request('POST', 'https://api.av.by/offer-types/cars/filters/main/apply', [
            'body' => json_encode([
                "page" => $page,
                "properties" => [
                    [
                        "name" => "price_currency",
                        "value" => 2
                    ]
                ],
                'sorting' => 4
            ]),
            'headers' => [
                'Accept' => '*/*',
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Accept-Language' => 'ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
                'x-api-key' => 'xf4ce68a022a442295534c1',
                'x-user-group' => '9b905931-441a-4bbd-8499-3c7964e0a381',
                'x-device-type' => 'web.desktop',
                'Content-Type' => 'application/json',
                'Origin' => 'https://cars.av.by',
                'Connection' => 'keep-alive',
                'Sec-Fetch-Dest' => 'empty',
                'Sec-Fetch-Mode' => 'cors',
                'Sec-Fetch-Site' => 'same-site',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'no-cache',
                'TE' => 'trailers',
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), false);

        app()->make(MakeCarByAvCarsAction::class, compact('response'))->handle();

        Cache::put('av:page', $page + 1, now()->addHour());

        return self::SUCCESS;
    }
}
