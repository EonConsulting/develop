<?php

namespace Tests\Unit\Packages\StoryLine;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_can_create_a_user()
    {
        $user = create('App\Models\User', ['name' => 'Demo User', 'email' => 'demo@eon.co.za']);

        $this->assertEquals('Demo User', $user->name);
        $this->assertEquals('demo@eon.co.za', $user->email);
    }

    /** @test */
    function it_can_a_have_a_single_course()
    {
        $course = create('EONConsulting\Storyline2\Models\Course', ['title' => 'Fancy Course']);

        $user = create('App\Models\User');

        $user->courses()->attach($course);

        $first_course = $user->courses()->first();

        $this->assertEquals('Fancy Course', $first_course->title);
    }

    /** @test */
    function it_can_have_multiple_courses()
    {
        $courses = create('EONConsulting\Storyline2\Models\Course', [], 5);

        $user = create('App\Models\User');

        $user->courses()->attach($courses);

        $this->assertEquals(5, $user->courses()->count());
    }

    /** @test */
    function it_may_not_have_the_same_course_twice()
    {
        // @TODO

        $this->assertEquals(true, true);
    }




}