<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Revalto\Telegram\Facades\Telegram;

class TestController extends Controller
{
    public function __construct(
        protected Client $client
    ) {}

    public function av(Request $request)
    {
        try {
//            $page = $request->get('page', 1);
//
//            $response = Cache::remember('av:cars:' . $page, now()->addMinutes(5), function () use ($page) {
//                $response = $this->client->request('POST', 'https://api.av.by/offer-types/cars/filters/main/apply', [
//                    'body' => json_encode([
//                        "page" => $page,
//                        "properties" => [
//                            [
//                                "name" => "brands",
//                                "property" => 6,
//                                "value" => [
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 6
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 7
//                                        ],
//                                        [
//                                            "name" => "generation",
//                                            "value" => 32
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 6
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 7
//                                        ],
//                                        [
//                                            "name" => "generation",
//                                            "value" => 31
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 6
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 10
//                                        ],
//                                        [
//                                            "name" => "generation",
//                                            "value" => 35
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 1216
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 5908
//                                        ],
//                                        [
//                                            "name" => "generation",
//                                            "value" => 4721
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 1216
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 5912
//                                        ],
//                                        [
//                                            "name" => "generation",
//                                            "value" => 4747
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 1216
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 1229
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 43
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 191
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 683
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 8
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 330
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 349
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 330
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 358
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 330
//                                        ],
//                                        [
//                                            "name" => "model",
//                                            "value" => 365
//                                        ]
//                                    ],
//                                    [
//                                        [
//                                            "name" => "brand",
//                                            "value" => 1039
//                                        ]
//                                    ]
//                                ]
//                            ],
//                            [
//                                "name" => "price_usd",
//                                "value" => [
//                                    "max" => "2000",
//                                    "min" => null
//                                ]
//                            ],
//                            [
//                                "name" => "price_currency",
//                                "value" => 2
//                            ],
//                            [
//                                "name" => "place_region",
//                                "value" => [
//                                    1004
//                                ]
//                            ],
//                            [
//                                "name" => "condition",
//                                "value" => [
//                                    2,
//                                    1
//                                ]
//                            ],
//                            [
//                                "name" => "creation_date",
//                                "value" => 16
//                            ]
//                        ]
//                    ]),
//                    'headers' => [
//                        'Accept' => '*/*',
//                        'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
//                        'Accept-Language' => 'ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
//                        'x-api-key' => 'xf4ce68a022a442295534c1',
//                        'x-user-group' => '9b905931-441a-4bbd-8499-3c7964e0a381',
//                        'x-device-type' => 'web.desktop',
//                        'Content-Type' => 'application/json',
//                        'Origin' => 'https://cars.av.by',
//                        'Connection' => 'keep-alive',
//                        'Sec-Fetch-Dest' => 'empty',
//                        'Sec-Fetch-Mode' => 'cors',
//                        'Sec-Fetch-Site' => 'same-site',
//                        'Pragma' => 'no-cache',
//                        'Cache-Control' => 'no-cache',
//                        'TE' => 'trailers',
//                    ]
//                ]);
//
//                return json_decode($response->getBody()->getContents(), true);
//            });

//            dd($response);

//            return view('av', [
//                'response' => $response
//            ]);
        } catch (GuzzleException $e) {
            dd($e);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
