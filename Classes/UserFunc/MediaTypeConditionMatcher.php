<?php

declare(strict_types=1);

namespace In2code\Panopto\UserFunc;

use TYPO3\CMS\Backend\Form\FormDataProvider\EvaluateDisplayConditions;

class MediaTypeConditionMatcher
{
    public function checkMediaType(array $args, EvaluateDisplayConditions $pObj): bool
    {
        if (!empty($args['conditionParameters'][0])) {
            $sysFile = $args['record']['uid_local'][0]['row'];
            $mediaTypeExtension = $args['conditionParameters'][0];

            if ($sysFile['extension'] === $mediaTypeExtension) {
                return true;
            }
        }

        return false;
    }
}
