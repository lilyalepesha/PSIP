<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class JSONCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'json:start';

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
        $response = json_decode(file_get_contents(storage_path('app/public/firstload/generations.json')));

        $modelId = 1;
        $generationId = 1;

        foreach ($response as $key => $brand) {
            foreach ($brand->models as $i => $model) {
                foreach ($model->generations as $k => $generation) {
                    if($generationId < 2000) {
                        $generationId++;

                        continue;
                    }

//                    echo '[\'id\' => ' . $generationId . ', \'external_id\' => ' . $generation->id . ', \'title\' => "' . $generation->name . '", \'model_id\' => ' . $modelId . ', \'started_year\' => ' . ($generation->yearFrom ?? 'null') . ', \'ended_year\' => ' . ($generation->yearTo ?? 'null') . '],' . PHP_EOL;

                    $generationId++;
                }

//                echo '[\'id\' => ' . $modelId . ', \'external_id\' => ' . $model->id . ', \'title\' => "'. Str::replace('"', "'", $model->name) .'", \'brand_id\' => ' . ($key + 1) . '],' . PHP_EOL;

                $modelId++;
            }
        }

        return Command::SUCCESS;
    }
}
