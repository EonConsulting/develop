<?php
use \Tsugi\Util\LTI;
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Lessons;
use \Tsugi\Grades\GradeUtil;

require_once "top.php";
if ( ! isset($CFG->lessons) ) {
    die_with_error_log('Cannot find lessons.json');
}

// Load the Lesson
$l = new Lessons($CFG->lessons);

$OUTPUT->bodyStart();
$OUTPUT->topNav();
$OUTPUT->flashMessages();

// Load all the Grades so far
$allgrades = array();
if ( isset($_SESSION['id']) && isset($_SESSION['context_id'])) {
    $rows = GradeUtil::loadGradesForCourse($_SESSION['id'], $_SESSION['context_id']);
    foreach($rows as $row) {
        $allgrades[$row['resource_link_id']] = $row['grade'];
    }
}

$l->renderBadges($allgrades);

$OUTPUT->footer();
