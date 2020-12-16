<?php

namespace In2code\Panopto\Resource\Rendering;

use In2code\Panopto\Utility\ConfigurationUtility;
use In2code\Panopto\Utility\UrlUtility;
use TYPO3\CMS\Core\Resource\FileInterface;

/**
 * Panopto renderer class
 */
class PanoptoRenderer extends AbstractRenderer
{
    /**
     * Check if given File(Reference) can be rendered
     *
     * @param FileInterface $file File of FileReference to render
     * @return bool
     */
    public function canRender(FileInterface $file)
    {
        return ($file->getMimeType() === 'video/pan' || $file->getExtension() === 'pan') &&
            $this->getOnlineMediaHelper($file) !== false;
    }

    /**
     * Render for given File(Reference) html output
     *
     * @param FileInterface $file
     * @param int|string $width TYPO3 known format; examples: 220, 200m or 200c
     * @param int|string $height TYPO3 known format; examples: 220, 200m or 200c
     * @param array $options
     * @param bool $usedPathsRelativeToCurrentScript See $file->getPublicUrl()
     * @return string
     */
    public function render(
        FileInterface $file,
        $width,
        $height,
        array $options = [],
        $usedPathsRelativeToCurrentScript = false
    ) {
        $src = $this->createUrl($file);
        $attributes = $this->collectIframeAttributes($width, $height, $options);

        return sprintf(
            '<iframe src="%s"%s></iframe>',
            htmlspecialchars($src, ENT_QUOTES | ENT_HTML5),
            empty($attributes) ? '' : ' ' . $this->implodeAttributes($attributes)
        );
    }

    /**
     * @param FileInterface $file
     * @return string
     */
    protected function createUrl(FileInterface $file): string
    {
        $videoId = $this->getVideoIdFromFile($file);
        $settings = ConfigurationUtility::getTyposcriptConfiguration();;

        if (array_key_exists('domain', $settings) && array_key_exists('path', $settings)) {
            return UrlUtility::buildPanoptoUrl(
                $settings['domain'],
                $settings['path'],
                [
                    'videoUid' => $videoId,
                    'playerType' => $file->getProperty('tx_panopto_player_type'),
                    'showbrand' => $file->getProperty('tx_panopto_show_brand'),
                    'offerviewer' => $file->getProperty('tx_panopto_offer_viewer'),
                    'showTitle' => $file->getProperty('tx_panopto_show_title'),
                    'startOffset' => $file->getProperty('tx_panopto_start_offset'),
                    'autoplay  ' => $file->getProperty('autoplay')
                ]
            );
        }

        return '';
    }
}

