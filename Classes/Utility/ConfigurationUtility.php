<?php

declare(strict_types=1);

namespace In2code\Panopto\Utility;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class ConfigurationUtility
{
    /**
     * @return array
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     * @throws \TYPO3\CMS\Extbase\Object\Exception
     */
    public static function getTyposcriptConfiguration(): array
    {
        return ObjectUtility::getConfigurationManager()->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'panopto'
        );
    }
}
