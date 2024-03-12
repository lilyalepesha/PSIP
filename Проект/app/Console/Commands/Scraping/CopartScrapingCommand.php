<?php

namespace App\Console\Commands\Scraping;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CopartScrapingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:copart';

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
    public function handle(): int
    {
        $response = (new Client())->request('POST', 'https://www.copart.com/public/lots/search-results', [
//            'body' => json_encode([
//                "query" => ["*"],
//                "filter" => (object)[],
//                "sort" => [
//                    "member_damage_group_priority asc",
//                    "auction_date_type desc",
//                    "auction_date_utc asc",
//                ],
//                "page" => 0,
//                "size" => 20,
//                "start" => 0,
//                "watchListOnly" => false,
//                "freeFormSearch" => false,
//                "hideImages" => false,
//                "defaultSort" => false,
//                "specificRowProvided" => false,
//                "displayName" => "",
//                "searchName" => "",
//                "backUrl" => "",
//                "includeTagByField" => (object)[],
//                "rawParams" => (object)[],
//            ]),
            'body' => json_encode([
                "query" => ["*"],
                "filter" => [
                    "NLTS" => [
                        "expected_sale_assigned_ts_utc:[NOW/DAY-1DAY TO NOW/DAY]"
                    ]
                ],
                "sort" => [
                    "member_damage_group_priority asc",
                    "auction_date_type desc",
                    "auction_date_utc asc"
                ],
                "page" => 0,
                "size" => 20,
                "start" => 0,
                "watchListOnly" => false,
                "freeFormSearch" => false,
                "hideImages" => false,
                "defaultSort" => false,
                "specificRowProvided" => false,
                "displayName" => "",
                "searchName" => "",
                "backUrl" => "",
                "includeTagByField" => (object)[],
                "rawParams" => (object)[]
            ]),
            'headers' => [
                "User-Agent" => "Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0",
                "Accept" => "*/*",
                "Accept-Language" => "ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3",
                "Sec-Fetch-Dest" => "empty",
                "Sec-Fetch-Mode" => "no-cors",
                "Sec-Fetch-Site" => "same-origin",
                "Content-Type" => "application/json",
                "Pragma" => "no-cache",
                "Cache-Control" => "no-cache"
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), false);

        dd($response);

        return self::SUCCESS;
    }
}
