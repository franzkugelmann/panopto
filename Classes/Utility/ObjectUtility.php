<?php

declare(strict_types=1);

namespace In2code\Panopto\Utility;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

class ObjectUtility
{
    /**
     * @return ConfigurationManager
     */
    public static function getConfigurationManager(): ConfigurationManager
    {
        return GeneralUtility::makeInstance(ConfigurationManager::class);
    }
}
