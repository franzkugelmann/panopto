<?php

/**
 * Custom Content Element: Panopto
 */

$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
    'LLL:EXT:panopto/Resources/Private/Language/locallang_db.xlf:ce.panopto.header',
    'ce.panopto',
    'ce.panopto'
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['ce.panopto'] = 'ce.panopto';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:panopto/Configuration/FlexForm/Panopto.xml',
    'ce.panopto'
);

$GLOBALS['TCA']['tt_content']['types']['ce.panopto'] = [
    'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,--palette--;;header, pi_flexform,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,'
];
