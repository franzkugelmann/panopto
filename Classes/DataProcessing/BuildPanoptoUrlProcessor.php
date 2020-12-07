<?php

declare(strict_types=1);

namespace In2code\Panopto\DataProcessing;

use TYPO3\CMS\Core\Utility\MathUtility;
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
    protected string $defaultVariableName = 'panoptoUrl';

    protected array $processorConfiguration = [];

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
            $url = $this->buildUrl($flexFormData);
            $targetVariableName = $cObj->stdWrapValue('as', $this->processorConfiguration);

            if (!empty($targetVariableName)) {
                $processedData[$targetVariableName] = $url;
            } else {
                $processedData[$this->defaultVariableName] = $url;
            }
        }

        return $processedData;
    }

    protected function buildUrl(array $settings): string
    {
        $url = '';
        $domain = rtrim($this->processorConfiguration['domain'], '/') . '/';
        $path = rtrim(ltrim($this->processorConfiguration['path'], '/'), '/') . '/';

        if (empty($settings['playerType']) && ($settings['playerType'] !== 'Embed' || $settings['playerType'] !== 'Viewer')) {
            $playerType = 'Embed';
        } else {
            $playerType = $settings['playerType'];
        }

        if (!empty($settings['videoUid'])) {
            $url = $domain . $path . $playerType . '.aspx?id=' . $settings['videoUid'];

            $options = [
                'autoplay' => (bool)$settings['autoplay'],
                'showbrand' => (bool)$settings['showBrand'],
                'offerviewer' => (bool)$settings['offerViewer'],
                'showTitle' => (bool)$settings['showTitle'],
            ];

            foreach ($options as $option => $value) {
                if ($value) {
                    $value = 'true';
                } else {
                    $value = 'false';
                }

                $url .= '&' . $option . '=' . $value;
            }

            if ($settings['startOffset'] !== '' && MathUtility::canBeInterpretedAsInteger($settings['startOffset'])) {
                $url .= '&start=' . $settings['startOffset'];
            }
        }

        return $url;
    }
}
