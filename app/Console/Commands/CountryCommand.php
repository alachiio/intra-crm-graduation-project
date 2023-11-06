<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CountryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'countries:insert';

    protected $url = 'https://restcountries.com/v3.1/all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert Countries from https://restcountries.com/v3.1/all';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        $result = curl_exec($ch);
        curl_close($ch);

        $countries = json_decode($result);
        if (!$countries) {
            $this->error('No countries has been crawled, check your internet connection');
            die;
        }
        $countries = Arr::map($countries, function ($item) {
            return ['meta' => json_encode($item)];
        });
        DB::table('countries')->truncate();
        Country::query()->insert($countries);

        $this->info('Countries has been inserted successfully');
    }
}
