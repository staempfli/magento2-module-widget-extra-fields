<?php
/**
 * WysiwygImagePlugin
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Plugin;

use Magento\Cms\Helper\Wysiwyg\Images as WysiwygImageHelper;
use Magento\Cms\Block\Adminhtml\Wysiwyg\Images\Content as WysiwygImageContent;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\FileSystem;
use Magento\Framework\App\RequestInterface;

class WysiwygImagePlugin
{
    /**
     * @var \Magento\Framework\Filesystem\Directory\ReadInterface
     */
    private $mediaDir;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private $request;

    public function __construct(
        FileSystem $fileSystem,
        RequestInterface $request
    ) {
        $this->mediaDir = $fileSystem->getDirectoryRead(DirectoryList::MEDIA);
        $this->request = $request;
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
        $result = $proceed($filename, $renderAsTag);
        return $result;
    }

    /**
     * set widget info for on insert
     * @param WysiwygImageContent $subject
     * @param callable $proceed
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundGetOnInsertUrl(
        WysiwygImageContent $subject,
        callable $proceed
    ) {
        return $subject->getUrl(
            'cms/*/onInsert',
            ['widget' => $this->request->getParam('widget')]);
    }

    /**
     * check if result should be a relativ path
     * @param $renderAsTag
     * @return bool
     */
    private function returnRelativePath($renderAsTag): bool
    {
        if (!$renderAsTag && $this->request->getParam('widget')) {
            return true;
        }
        return false;
    }
}
