<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\School;
use DB;

class StudentSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Student::factory()->count(10)->create();

        $schools = School::get();
     
       foreach ($schools as $school) {
            $i = 1;
            $students = Student::where('school_id', $school->id)->get()->toArray();
           
                $order = $i;
                DB::table('students')
                        ->whereIn('id', $students)
                        ->update(['order' => order + 1]);

                $i++;
           // }
        }
    }

}
