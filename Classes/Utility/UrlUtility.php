<?php

namespace In2code\Panopto\Utility;

use TYPO3\CMS\Core\Utility\MathUtility;

class UrlUtility
{
    /**
     * @param string $url
     * @param string $target
     * @return bool
     */
    public static function isTargetHost(string $url, string $target): bool
    {
        if (self::getDomain($url) === $target) {
            return true;
        }

        return false;
    }

    /**
     * @param string $url
     * @return string|null
     */
    public static function getDomain(string $url): ?string
    {
        $host = parse_url($url, PHP_URL_HOST);

        if ($host) {
            $hostParts = explode(".", $host);
            return $hostParts[count($hostParts) - 2] . "." . $hostParts[count($hostParts) - 1];
        }

        return null;
    }

    /**
     * @param string $domain
     * @param string $path
     * @param array $settings
     * @return string
     */
    public static function buildPanoptoUrl(string $domain, string $path, array $settings): string
    {
        $url = '';
        $domain = rtrim($domain, '/') . '/';
        $path = rtrim(ltrim($path, '/'), '/') . '/';

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
