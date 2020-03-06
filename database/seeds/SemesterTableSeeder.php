<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('semesters')->insert([ 
            'sem_name' => 'Semester 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('semesters')->insert([ 
            'sem_name' => 'Semester 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('semesters')->insert([ 
            'sem_name' => 'Semester 3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('semesters')->insert([ 
            'sem_name' => 'Semester 4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('semesters')->insert([ 
            'sem_name' => 'Semester 5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('semesters')->insert([ 
            'sem_name' => 'Semester 6',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
    }
}
