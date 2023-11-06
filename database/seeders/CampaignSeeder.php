<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campaign::factory(5)->afterCreating(function (Campaign $campaign) {
            Lead::factory(10)->state([
                'campaign_id' => $campaign->id,
                'interested_products' => $campaign->getProducts()->limit(2)->pluck('id')->toJson(),
            ])->create();
        })->create();
    }
}
