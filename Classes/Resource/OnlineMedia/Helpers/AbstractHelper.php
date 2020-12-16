<?php

namespace In2code\Panopto\Resource\OnlineMedia\Helpers;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\AbstractOnlineMediaHelper;

/**
 * Abstract helper class
 */
abstract class AbstractHelper extends AbstractOnlineMediaHelper
{
    /**
     * Get local absolute file path to preview image
     *
     * @param File $file
     * @return string
     */
    public function getPreviewImage(File $file): string
    {
        return '';
    }

    /**
     * Get meta data for OnlineMedia item
     * Using the meta data from oEmbed
     *
     * @param File $file
     * @return array with metadata
     */
    public function getMetaData(File $file): array
    {
        $metadata = [];

        return $metadata;
    }

    /**
     * Transform mediaId to File
     *
     * @param string $mediaId
     * @param Folder $targetFolder
     * @param string $fileExtension
     * @return File
     */
    protected function transformMediaIdToFile(string $mediaId, Folder $targetFolder, string $fileExtension): File
    {
        $file = $this->findExistingFileByOnlineMediaId($mediaId, $targetFolder, $fileExtension);

        // no existing file create new
        if ($file === null) {
            $fileName = $mediaId . '.' . $fileExtension;

            $file = $this->createNewFile($targetFolder, $fileName, $mediaId);
        }
        return $file;
    }
}
