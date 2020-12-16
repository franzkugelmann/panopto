<?php

declare(strict_types=1);

namespace In2code\Panopto\Utility;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class ObjectUtility
{
    /**
     * @return ObjectManager
     */
    public static function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * @return ConfigurationManager
     * @throws \TYPO3\CMS\Extbase\Object\Exception
     */
    public static function getConfigurationManager(): ConfigurationManager
    {
        return self::getObjectManager()->get(ConfigurationManager::class);
    }
}
