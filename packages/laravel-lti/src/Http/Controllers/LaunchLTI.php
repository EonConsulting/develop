<?php

namespace EONConsulting\LaravelLTI\Http\Controllers;

use Illuminate\Http\Request;
use Tsugi\Config\ConfigInfo;
use Tsugi\Core\LTIX;
use Tsugi\Util\LTI;

use \Tsugi\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use \Tsugi\OAuth\OAuthConsumer;
use \Tsugi\OAuth\OAuthRequest;

class LaunchLTI {
    /**
     * @param $user
     * @return mixed
     */
    static public function feed_user_lti_details($user) {
        return laravel_lti()->get_user_lti_details($user);
    }

    static public function launch($launch_url = '', $key = '', $secret = '')
    {
        \Debugbar::disable();

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

        $endpoint = $launch_url;
        $endpoint = ConfigInfo::removeRelativePath($endpoint);

        $params = self::signRequest($endpoint, $key, $secret, $params);

        return view('eon.laravellti::launch', ['url' => $endpoint, 'inputs' => $params]);
    }

    public static function signRequest($url, $consumer_key, $consumer_secret, $params)
    {

        $query_params = array();

        $query_string = parse_url($url, PHP_URL_QUERY);

        if (!is_null($query_string)) {

            $query_items = explode('&', $query_string);

            foreach ($query_items as $item)
            {
                if (strpos($item, '=') !== FALSE)
                {
                    list($name, $value) = explode('=', $item);
                    $query_params[$name] = $value;
                } else {
                    $query_params[$name] = '';
                }
            }
        }

        $params = $params + $query_params;
        $params['oauth_callback'] = 'about:blank';
        $params['oauth_consumer_key'] = $consumer_key;

        $hmac_method = new OAuthSignatureMethod_HMAC_SHA1();
        $consumer = new OAuthConsumer($consumer_key, $consumer_secret, NULL);
        $req = OAuthRequest::from_consumer_and_token($consumer, NULL, 'POST', $url, $params);
        $req->sign_request($hmac_method, $consumer, NULL);
        $params = $req->get_parameters();

        foreach (array_keys($query_params) as $name)
        {
            unset($params[$name]);
        }

        return $params;
    }
}