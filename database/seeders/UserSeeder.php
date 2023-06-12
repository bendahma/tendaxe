<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        DB::table('users')->insert([
            'nom' => "Maine",
            'prenom' => "James",
            'nom_entreprise' => "boss",
            'phone' => "",
            'wilaya' => "",
            'commune' => "",
            'type_user' => "admin",
            'email' => "admin@tendaxe.com",
            'password' => Hash::make("password"),
        ]);
        // etablissement
        DB::table('etablissements')->insert([
            'nom_etablissement' => "etab A",
            'category' => Str::random(10),
            'fix' => "1234567",
            'wilaya' => "Blida",
            'commune' => "Blida",
        ]);

        // createur de contenu
        DB::table('users')->insert([
            'nom' => "Bouaza",
            'prenom' => "abdessamed",
            'nom_entreprise' => "entreprise A",
            'phone' => "1234567",
            'wilaya' => "Blida",
            'commune' => "Blida",
            'type_user' => "content",
            'email' => "content@tendaxe.com",
            'password' => Hash::make("password"),
            'etablissement_id' => 1,
        ]);

        // abonné
        for($i=1; $i<=20; $i++){
            DB::table('users')->insert([
                'nom' => Str::random(10),
                'prenom' => Str::random(10),
                'nom_entreprise' => Str::random(10),
                'phone' => Str::random(10),
                'wilaya' => Str::random(10),
                'commune' => Str::random(10),
                'email' => "$i@tendaxe.com",
                'password' => Hash::make("password"),
                'exp' => Carbon::now()->addDays(5),
            ]);
        }
        
    }
}
