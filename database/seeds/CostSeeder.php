<?php

use Illuminate\Database\Seeder;

class CostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Model\Cost::create([
            'program'=>"TPPM",
            "type"=>"A",
            "subject_fee_semester"=>3800,
            "additional_subject_fee_semester"=>3800,
            "extra_curricular_subject_fee_month"=>600,
            "reg_fee"=>5500,
            "re_reg_free"=>2500
        ]);

        \App\Model\Cost::create([
            'program'=>"TPPM",
            "type"=>"B",
            "subject_fee_semester"=>4560,
            "additional_subject_fee_semester"=>4560,
            "extra_curricular_subject_fee_month"=>600,
            "reg_fee"=>5500,
            "re_reg_free"=>2500
        ]);
    }
}
