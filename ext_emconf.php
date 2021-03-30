<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'panopto',
    'description' => 'Adds a content element for the end-to-end-video-content-management-system panopto',
    'category' => 'plugin',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'author' => 'Sebastian Stein',
    'author_email' => 'sebastian.stein@in2code.de',
    'author_company' => 'in2code GmbH',
    'version' => '2.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
