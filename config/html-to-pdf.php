<?php

return [
    //'binary' => '/usr/bin/wkhtmltopdf',
    //'no-outline',         // Make Chrome not complain
    'margin-top'    => 10,
    'margin-right'  => 10,
    'margin-bottom' => 10,
    'margin-left'   => 10,
    'javascript-delay' => 2000,
    // Explicitly tell wkhtmltopdf that we're using an X environment
   // 'use-xserver',

    // Enable built in Xvfb support in the command
    'commandOptions' => array(
        'enableXvfb' => true,

        // Optional: Set your path to xvfb-run. Default is just 'xvfb-run'.
        'xvfbRunBinary' => '/usr/bin/xvfb-run',

        // Optional: Set options for xfvb-run. The following defaults are used.
        'xvfbRunOptions' =>  '--auto-servernum',
    ),
];