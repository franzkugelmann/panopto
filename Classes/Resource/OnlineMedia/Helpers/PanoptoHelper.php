<?php

namespace In2code\Panopto\Resource\OnlineMedia\Helpers;

use In2code\Panopto\Utility\ConfigurationUtility;
use In2code\Panopto\Utility\UrlUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;

/**
 * ZdfMediathek helper class
 */
class PanoptoHelper extends AbstractHelper
{
    /**
     * @var string
     */
    protected $extension = 'pan';

    /**
     * Get public url
     *
     * @param File $file
     * @param bool $relativeToCurrentScript
     * @return string|null
     */
    public function getPublicUrl(File $file, $relativeToCurrentScript = false): ?string
    {
        $videoId = $this->getOnlineMediaId($file);
        $settings = ConfigurationUtility::getTyposcriptConfiguration();

        if (array_key_exists('domain', $settings) && array_key_exists('path', $settings)) {
            return UrlUtility::buildPanoptoUrl($settings['domain'], $settings['path'], ['videoUid' => $videoId]);
        }

        return null;
    }

    /**
     * Try to transform given URL to a File
     *
     * @param string $url
     * @param Folder $targetFolder
     * @return File|null
     */
    public function transformUrlToFile($url, Folder $targetFolder): ?File
    {
        if (!UrlUtility::isTargetHost($url, 'panopto.eu')) {
            return null;
        }

        $mediaId = $this->getMediaId($url);

        if (empty($mediaId)) {
            return null;
        }
        return $this->transformMediaIdToFile($mediaId, $targetFolder, $this->extension);
    }

    /**
     * @param string $url
     * @return string|null
     */
    protected function getMediaId(string $url): ?string
    {
        $urlParts = parse_url($url);

        if (!empty($urlParts['query'])) {
            parse_str($urlParts['query'], $params);

            if (!empty($params['id'])) {
                return $params['id'];
            }
        }


        return null;
    }
}
