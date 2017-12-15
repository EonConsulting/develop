<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tao Config
    |--------------------------------------------------------------------------
    */

    'api_url' => env('TAO_API_URL', ''),
    'api_user' => env('TAO_API_USER', ''),
    'api_pass' => env('TAO_API_PASS', ''),

    'launch-options' => [

        'key' => env('TAO_OAUTH_KEY', ''),
        'secret' => env('TAO_OAUTH_SECRET', ''),

        'lti_message_type' => 'basic-lti-launch-request',
        'lti_version' => 'LTI-1p0',

        'launch_presentation_locale' => 'en-US',
        'launch_presentation_document_target' => 'iframe',
        'launch_presentation_css_url' => 'https://unisa.synergi.io/css/tao.css',
        'launch_presentation_width' => '100%',
        'launch_presentation_height' => '800px',

        'tool_consumer_info_product_family_code' => 'unisa-e-content',
        'tool_consumer_info_version' => '1.0',
        'tool_consumer_instance_guid' => 'lmsng.school.edu',
        'tool_consumer_instance_name' => 'Unisa E-content',
        'tool_consumer_instance_description' => 'unisa e-content system',

        'tool_consumer_instance_contact_email' => 'unisa@unisa-offline.eon.dev',

        'custom_skip_thankyou' => 'true',
        'custom_force_restart' => 'true',
    ]




];