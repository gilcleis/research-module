<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = [
            ['name' => 'Quantos dias na semana você prefere trabalhar em home-office?','dimension_id' => '1','status'=>'A'],
            ['name' => 'De 0 a 10, como você avalia a sua disposição para o dia?','dimension_id' => '2','status'=>'I'],
            ['name' => 'O quanto você se sente atraído pelas oportunidades de carreira que a empresa oferece?' ,'dimension_id' => '3','status'=>'A']
        ];
        foreach ($dates as $date) {
            Question::create($date);
        }
    }
}
