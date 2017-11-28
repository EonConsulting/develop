<?php

namespace Tests\Unit\Packages\StoryLine;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_can_create_a_course()
    {
        $course = create('EONConsulting\Storyline2\Models\Course', ['title' => 'Test Course', 'description' => 'some description']);

        $this->assertEquals('Test Course', $course->title);
        $this->assertEquals('some description', $course->description);
    }

    /** @test */
    function it_can_a_have_a_single_user()
    {
        $course = create('EONConsulting\Storyline2\Models\Course');

        $user = create('App\Models\User', ['name' => 'Demo User']);

        $course->users()->attach($user);

        $first_user = $course->users()->first();

        $this->assertEquals('Demo User', $first_user->name);
    }

    /** @test */
    function it_can_have_multiple_users()
    {
        $course = create('EONConsulting\Storyline2\Models\Course');

        $users= create('App\Models\User', [], 5);

        $course->users()->attach($users);

        $this->assertEquals(5, $course->users()->count());
    }



}

