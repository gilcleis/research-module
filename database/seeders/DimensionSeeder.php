<?php

namespace Database\Seeders;

use App\Models\Dimension;
use Illuminate\Database\Seeder;

class DimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = [
            ['name' => 'Estrutura'],
            ['name' => 'Bem-estar'],
            ['name' => 'Carreira']
        ];
        foreach ($dates as $date) {
            Dimension::create($date);
        }
    }
}
