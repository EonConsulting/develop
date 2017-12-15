<?php

namespace EONConsulting\TaoClient\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EONConsulting\TaoClient\Models\TaoAssessment;
use EONConsulting\TaoClient\Models\TaoResult;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use EONConsulting\TaoClient\Services\UUID;
use Tsugi\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use Tsugi\OAuth\OAuthConsumer;
use Tsugi\OAuth\OAuthRequest;
use Auth;
use Log;

class TaoController extends Controller
{
    /**
     * TaoController constructor.
     */
    public function __construct()
    {
        \Debugbar::disable();
    }

    /**
     * Store Tao Details
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'launch_url' => 'required',
        ]);

        $assessment = TaoAssessment::firstOrCreate([
            'launch_url' => $validated_data['launch_url'],
        ],[
            'launch_url' => $validated_data['launch_url'],
            'key' => config('tao-client.launch-options.key'),
            'secret' => config('tao-client.launch-options.secret'),
        ]);

        return response()->json(['status'  => 'success']);
    }

    /**
     * Show the Tao iframe
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $validated_data = $request->validate([
            'launch_url' => 'required',
        ]);

        try {

            $assessment = TaoAssessment::byLaunchUrl($validated_data['launch_url'])->firstOrFail();

        } catch(ModelNotFoundException $e)
        {
            Log::debug('TaoController: | ' . $e->getMessage());

            return view('tao-client::launch-failed');
        }

        $lis_result_sourcedid = UUID::make();

        $user = auth()->user();

        if( ! $storyline_item_id = $assessment->storyline_item_id)
        {
            $storyline_item_id = 0;
        }

        $tao_result = TaoResult::firstOrCreate([
            'user_id' => $user->id,
            'storyline_item_id' => $storyline_item_id,
            'lis_result_sourcedid' => $lis_result_sourcedid
        ]);

        $params = $this->buildParams($user, $lis_result_sourcedid);

        $params = $this->signRequest($assessment->launch_url, $assessment->key, $assessment->secret, $params);

        return view('tao-client::launch', ['url' => $assessment->launch_url, 'inputs' => $params]);
    }

    /**
     * Sign the LTI request using oAuth
     *
     * @param $url
     * @param $consumer_key
     * @param $consumer_secret
     * @param $params
     * @return array|null
     */
    protected function signRequest($url, $consumer_key, $consumer_secret, $params)
    {
        $params['oauth_callback'] = 'about:blank';

        $hmac_method = new OAuthSignatureMethod_HMAC_SHA1();

        $test_consumer = new OAuthConsumer($consumer_key, $consumer_secret, NULL);

        $acc_req = OAuthRequest::from_consumer_and_token($test_consumer, null, 'POST', $url, $params);

        $acc_req->sign_request($hmac_method, $test_consumer, null);

        $params = $acc_req->get_parameters();

        return $params;
    }

    /**
     * Return LTI params
     *
     * @param $user
     * @param $lis_result_sourcedid
     * @return array
     */
    protected function buildParams($user, $lis_result_sourcedid)
    {
        $params = [

            'resource_link_id' => '12345',
            'resource_link_title' => 'Title for thing',
            'resource_link_description' => 'desc',

            'user_id' => $user->id,
            'user_image' => '',
            'roles' => $user->lti_role,

            'lis_person_name_full' => $user->name,
            'lis_person_name_given' => $user->first_name,
            'lis_person_name_family' => $user->last_name,
            'lis_person_contact_email_primary' => $user->email,

            'context_id' => 'unique-01235',
            'context_type' => 'CourseSection',
            'context_title' => 'Test Course',
            'context_label' => 'testcourse',

            'lis_result_sourcedid' => $lis_result_sourcedid,

            'launch_presentation_return_url' => route('tao-outcome.show'),
            'tool_consumer_instance_url' => route('tao-outcome.show'),
            'lis_outcome_service_url' => route('tao-outcome.store'),
        ];

        $default_settings = config('tao-client.launch-options');

        return array_merge($params, $default_settings);
    }

}