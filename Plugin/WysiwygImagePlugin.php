<?php
/**
 * WysiwygImagePlugin
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Plugin;

use Magento\Cms\Helper\Wysiwyg\Images as WysiwygImageHelper;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;

class WysiwygImagePlugin
{
    /**
     * @param WysiwygImageHelper $subject
     * @param callable $proceed
     * @param $filename
     * @param bool $renderAsTag
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundGetImageHtmlDeclaration(
        WysiwygImageHelper $subject,
        callable $proceed,
        $filename,
        $renderAsTag = false
    ) {
        if ($this->shouldSimplyReturnRelativePath($renderAsTag)) {
            return $this->getWysiwygRelativePath($filename);
        }
        $result = $proceed();
        return $result;
    }

    private function shouldSimplyReturnRelativePath($renderAsTag)
    {
        if (!$renderAsTag) {
            return true;
        }
        return false;
    }

    private function getWysiwygRelativePath($filename)
    {
        return WysiwygConfig::IMAGE_DIRECTORY . DIRECTORY_SEPARATOR . $filename;
    }
}