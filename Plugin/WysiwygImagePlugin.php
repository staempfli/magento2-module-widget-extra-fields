<?php
/**
 * WysiwygImagePlugin
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Plugin;

use Magento\Cms\Helper\Wysiwyg\Images as WysiwygImageHelper;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\FileSystem;

class WysiwygImagePlugin
{
    /**
     * @var \Magento\Framework\Filesystem\Directory\ReadInterface
     */
    private $mediaDir;

    public function __construct(FileSystem $fileSystem)
    {
        $this->mediaDir = $fileSystem->getDirectoryRead(DirectoryList::MEDIA);
    }

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
        if ($this->returnRelativePath($renderAsTag)) {
            $absolutePath = $subject->getCurrentPath() . '/' . $filename;
            return $this->mediaDir->getRelativePath($absolutePath);
        }
        $result = $proceed();
        return $result;
    }

    private function returnRelativePath($renderAsTag): bool
    {
        if (!$renderAsTag) {
            return true;
        }
        return false;
    }
}