<?php
defined('TYPO3_MODE') || die();

$tca = [
    'palettes' => [
        'panoptoPalette' => ['showitem' => 'tx_panopto_player_type, --linebreak--, tx_panopto_show_brand, tx_panopto_offer_viewer, tx_panopto_show_title, --linebreak--, tx_panopto_start_offset'],
    ],
    'columns' => [
        'tx_panopto_player_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.playerType',
            'displayCond' => 'USER:' . \In2code\Panopto\UserFunc\MediaTypeConditionMatcher::class . '->checkMediaType:pan',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.playerType.player',
                        'Embed'
                    ],
                    [
                        'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.playerType.viewer',
                        'Viewer'
                    ]
                ],
                'default' => 'Embed'
            ]
        ],
        'tx_panopto_show_brand' => [
            'exclude' => true,
            'label' => 'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.showBrand',
            'displayCond' => 'USER:' . \In2code\Panopto\UserFunc\MediaTypeConditionMatcher::class . '->checkMediaType:pan',
            'config' => [
                'type' => 'check',
                'default' => '1'
            ]
        ],
        'tx_panopto_offer_viewer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.offerViewer',
            'displayCond' => 'USER:' . \In2code\Panopto\UserFunc\MediaTypeConditionMatcher::class . '->checkMediaType:pan',
            'config' => [
                'type' => 'check',
                'default' => '0'
            ]
        ],
        'tx_panopto_show_title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.showTitle',
            'displayCond' => 'USER:' . \In2code\Panopto\UserFunc\MediaTypeConditionMatcher::class . '->checkMediaType:pan',
            'config' => [
                'type' => 'check',
                'default' => '1'
            ]
        ],
        'tx_panopto_start_offset' => [
            'exclude' => true,
            'label' => 'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.startOffset',
            'displayCond' => 'USER:' . \In2code\Panopto\UserFunc\MediaTypeConditionMatcher::class . '->checkMediaType:pan',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'eval' => 'trim, int',
                'default' => 0
            ]
        ],
    ]
];

$GLOBALS['TCA']['sys_file_reference'] = array_replace_recursive($GLOBALS['TCA']['sys_file_reference'], $tca);

$GLOBALS['TCA']['sys_file_reference']['types']['4']['showitem'] .= ',--palette--;;panoptoPalette';
