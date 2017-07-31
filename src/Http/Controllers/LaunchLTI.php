<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/13
 * Time: 1:39 PM
 */

namespace EONConsulting\LaravelLTI\Http\Controllers;

require_once "config.php";

use Illuminate\Http\Request;
use Tsugi\Config\ConfigInfo;
use Tsugi\Core\LTIX;
use Tsugi\Util\LTI;

class LaunchLTI {
    /**
     * @param $user
     * @return mixed
     */
    static public function feed_user_lti_details($user) {
        return laravel_lti()->get_user_lti_details($user);
    }

    static public function launch($launch_url = '', $key = '', $secret = '') {
        $user = auth()->user();
        $tool_consumer_instance_guid = 'lmsng.school.edu';
        $tool_consumer_instance_description = 'University of School (LMSng)';

        $params = [
            'lti_message_type' => 'basic-lti-launch-request',
            'lti_version' => 'LTI-1p0',
            'resource_link_id' => '12345',
            'resource_link_title' => 'Title for thing',
            'resource_link_description' => 'desc',
            'user_id' => 1235134,
            'user_image' => '',
            'roles' => self::feed_user_lti_details($user)['roles'],
//            'roles' => 'Learner',
            'lis_person_name_given' => 'Josh',
            'lis_person_name_family' => 'Harington',
            'lis_person_name_full' => 'Josh Harington',
            'lis_person_contact_email_primary' => 'josh1@live.co.za',
            'lis_person_sourcedid' => uniqid('source'),
            'lis_result_sourcedid' => uniqid('source'),
            'context_id' => '1',
            'context_type' => 'CourseSection',
            'context_title' => 'Design of Personal Environments',
            'context_label' => 'SI182',
            'launch_presentation_locale' => 'en-US',
            'launch_presentation_document_target' => 'iframe',
            'launch_presentation_width' => 320,
            'launch_presentation_height' => 500,
            'launch_presentation_return_url' => $launch_url,
            'tool_consumer_instance_guid' => $tool_consumer_instance_guid,
            'tool_consumer_instance_name' => 'SchoolU',
            'tool_consumer_instance_description' => $tool_consumer_instance_description,
            'tool_consumer_instance_url' => 'http://lmsng.school.edu',
            'tool_consumer_instance_contact_email' => 'System.Admin@school.edu'
        ];

//        $endpoint = str_replace("dev.php",$_POST['custom_assn'],$launch_url);
        $endpoint = $launch_url;
        $endpoint = ConfigInfo::removeRelativePath($endpoint);

        $parms = LTI::signParameters($params, $endpoint, "POST", $key, $secret,
            "Finish Launch", $tool_consumer_instance_guid, $tool_consumer_instance_description);

        $content = LTI::postLaunchHTML($parms, $endpoint, false,
            "width=\"100%\" height=\"750\" scrolling=\"auto\" frameborder=\"0\" transparency");
        return $content;
    }

}