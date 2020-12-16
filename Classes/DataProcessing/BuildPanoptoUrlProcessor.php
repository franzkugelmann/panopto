<?php

declare(strict_types=1);

namespace In2code\Panopto\DataProcessing;

use In2code\Panopto\Utility\UrlUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Minimal TypoScript configuration
 * Process panopto url and store it in "panoptoUrl"
 *
 * 10 = In2code\Panopto\DataProcessing\BuildPanoptoUrlProcessor
 *
 *
 * Advanced TypoScript configuration
 * Process panopto url and store it in "anotherUrl"
 *
 * 10 = In2code\Panopto\DataProcessing\BuildPanoptoUrlProcessor
 * 10 {
 *   as = anotherUrl
 * }
 */
class BuildPanoptoUrlProcessor implements DataProcessorInterface
{
    /**
     * @var string
     */
    protected $defaultVariableName = 'panoptoUrl';

    /**
     * @var array
     */
    protected $processorConfiguration = [];

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $flexFormData = $processedData['data']['pi_flexform']['settings'];
        $this->processorConfiguration = $processorConfiguration;

        if (!empty($flexFormData) && is_array($flexFormData) && array_key_exists('videoUid', $flexFormData)
        ) {
            $url =
                UrlUtility::buildPanoptoUrl(
                    $this->processorConfiguration['domain'],
                    $this->processorConfiguration['path'],
                    $flexFormData
                );
            $targetVariableName = $cObj->stdWrapValue('as', $this->processorConfiguration);

            if (!empty($targetVariableName)) {
                $processedData[$targetVariableName] = $url;
            } else {
                $processedData[$this->defaultVariableName] = $url;
            }
        }

        return $processedData;
    }


}
