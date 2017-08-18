<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'course_users';

    /**
     * Run the migrations.
     * @table course_users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('user_id')->default('27000000');
            $table->string('email', 191);
            $table->tinyInteger('opted_out')->default('0');
            $table->binary('opted_out_date')->nullable()->default(null);

            $table->index(["course_id"], 'course_users_ibfk_2');

            $table->index(["user_id"], 'course_users_ibfk_1');
            $table->timestamps();


            $table->foreign('course_id', 'course_users_ibfk_2')
                ->references('id')->on('courses')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id', 'course_users_ibfk_1')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
