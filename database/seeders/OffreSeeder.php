<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            DB::table('offres')->insert([
                'user_id' => 2,
                'titre' => Str::random(30),
                'description' => Str::random(50),
                'date_pub' => Carbon::now()->addDays(5)->toDateString(),
                'date_limit' => Carbon::now()->addDays(30)->toDateString(),
                'prix' => 12000,
                'wilaya' => rand(1, 48),
                'statut' => "",
                'type' => "admin",
            ]);
        }
    }
}
