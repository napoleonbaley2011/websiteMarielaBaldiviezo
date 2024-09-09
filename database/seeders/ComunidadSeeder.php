<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComunidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comunidades = [
            [
                'name' => 'Gamoneda',
                'description' => 'Subcentral Santa Ana'
            ],
            [
                'name' => 'Portillo',
                'description' => 'Subcentral Santa Ana'
            ],
        ];
    }
}
