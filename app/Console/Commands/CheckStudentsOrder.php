<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\School;
use DB;
class CheckStudentsOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fix reorder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
          $schools = School::get();
        
           foreach ($schools as $school) {
            $i = 1;
            $students = Student::where('school_id', $school->id)->get();
            foreach ($students as $student) {
                
                $order = $i;
                DB::table('students')
                        ->where('id', $student->id)
                        ->update(['order' => $order]);

                $i++;
            }
        }
    }
}
