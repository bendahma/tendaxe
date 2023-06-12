<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['secteur' => 'Bâtiments et Génie civil'],
            ['secteur' => 'Travaux Publics'],
            ['secteur' => 'Hydraulique et Environnement'],
            ['secteur' => 'Architecture, Urbanisme, contrôle et suivi'],
            ['secteur' => 'Equipement et Consommable industriel, pièce de rechange'],
            ['secteur' => 'Etude, Consulting, Formation et Certification'],
            ['secteur' => 'Papier, carton, emballage, plastique et caoutchouc'],
            ['secteur' => 'Informatique, Bureautique, Logiciels et multimédia'],
            ['secteur' => 'Mines ,carrières et matériaux de construction'],
            ['secteur' => 'Equipement et Consommable scientifique , médical et laboratoire'],
            ['secteur' => 'Véhicule et équipement de transport'],
            ['secteur' => 'Industrie électrique et Electrotechnique'],
            ['secteur' => 'Industries électroniques ,matériel audio-visuel et électroménager'],
            ['secteur' => 'Agriculture, Elevage, Forêts et Pêche'],
            ['secteur' => 'Assurance, Comptabilité, finance et services juridique'],
        ];
        DB::table('secteurs')->insert($data);
    }
}
