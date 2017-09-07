<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Routing\Controller as BaseController;
use EONConsulting\Storyline2\Models\Course;

class Storyline2ViewsBlade extends BaseController {

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index() {

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function view() {
        $breadcrumbs = [
          'title' => 'View [Course Name] Storyline' //pass $course as param and load name here
        ];

        return view('eon.storyline2::student.view', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function edit() {
        $breadcrumbs = [
          'title' => 'Edit [Course Name] Storyline' //pass $course as param and load name here
        ];

        return view('eon.storyline2::lecturer.edit', ['breadcrumbs' => $breadcrumbs]);
    }

}
