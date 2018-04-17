<?php

namespace EONConsulting\Core\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\LaravelLTI\Models\UserLTILink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use EONConsulting\Notifications\Notifications\WelcomePasswordReset;
use Exception;
use Excel;

class UsersImporterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:users:importer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to import users';

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
     * @return mixed
     */
    public function handle()
    {
        $students = Excel::load(storage_path('imports/students.csv'))->get();

        $failed_imports = [];

        foreach($students as $student)
        {
            $this->info("Importing Student: [{$student->student_number}] - {$student->first_names} {$student->last_name}");

            DB::beginTransaction();

            try {

                $user = User::updateOrCreate([
                    'id' => $student->student_number
                ],[
                    'id' => $student->student_number,
                    'name' => "{$student->first_names} {$student->last_name}",
                    'email' => $student->e_mail_address,
                    'password' => bcrypt(Str::random(30)),
                ]);

            } catch(Exception $exception)
            {
                DB::rollBack();

                $failed_imports[] = $this->reportError($student, $exception);

                continue;
            }

            try {

                $lis_person_sourcedid = 'ischool.edu:student';
                $roles = 'Learner';

                $lti_user = UserLTILink::updateOrCreate([
                    'user_id' => $user->id,
                    'lti_user_id' => $student->student_number,
                ], [
                    'lti_user_id' => $student->student_number,
                    'context_id' => $this->randomNumber(),
                    'lis_person_contact_email_primary' => $student->e_mail_address,
                    'lis_person_name_family' => $student->last_name,
                    'lis_person_name_full' => $student->first_names . ' ' . $student->last_name,
                    'lis_person_name_given' => $student->first_names,
                    'lis_person_sourcedid' => $lis_person_sourcedid,
                    'lis_result_sourcedid' => Str::random(30),
                    'roles' => $roles,
                ]);

            } catch(Exception $exception)
            {
                DB::rollBack();

                $failed_imports[] = $this->reportError($student, $exception);

                continue;
            }

            // add user to courses

            $courses = Course::all();

            $user->courses()->sync($courses);

            DB::commit();

            // email user a forgotten password link

            //$user->notify(new WelcomePasswordReset());

        }

        $this->logErrors($failed_imports);

        $this->info('Finished!');


        return;
    }

    /*
     * Generate a random number
     *
     * @param string $prefix
     * @param string $post_fix
     * @return string
     */
    protected function randomNumber($prefix = '', $post_fix = '')
    {
        return ( rand(000,111) . $prefix . time() . $post_fix);
    }

    /*
     * Create a CSV file with all the errors from the provided array
     *
     * @param array $errors
     * @return bool
     */
    protected function logErrors($errors = [])
    {
        if(count($errors) > 0)
        {
            Excel::create('imports/student-import-failed', function($excel) use ($errors)
            {
                $excel->sheet('Failed Imports', function($sheet) use ($errors)
                {
                    $sheet->fromArray($errors);
                });

            })->store('xls');
        }

        return true;
    }

    /*
     * Write to terminal and return a array with errors
     *
     * @param \Maatwebsite\Excel\Collections\CellCollection $student
     * @param Exception $exception
     * @return array
     */
    protected function reportError($student, Exception $exception)
    {
        $this->error("Problem Importing Student: [{$student->student_number}]");
        $this->error($exception->getMessage());

        return [
            'student_id' => $student->student_number,
            'error_message' => $exception->getMessage(),
        ];
    }

}
