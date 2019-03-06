<?php
/**
 * VideoFieldRenderer
 *
 * @copyright Copyright © 2019 Staempfli AG. All rights reserved.
 * @author    florian.auderset@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as FormElementFactory;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface as FormElementRenderer;
use Magento\Framework\UrlInterface;

class VideoFieldRenderer extends Template implements FormElementRenderer
{
    /**
     * @var AbstractElement
     */
    private $element;

    /**
     * @var string
     */
    protected $_template = 'Staempfli_WidgetExtraFields::renderer/video-field-renderer.phtml';
    /**
     * @var FormElementFactory
     */
    private $formElementFactory;

    public function __construct(
        FormElementFactory $formElementFactory,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formElementFactory = $formElementFactory;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $this->element = $element;
        return $this->toHtml();
    }

    public function getElement(): AbstractElement
    {
        return $this->element;
    }

    public function getUploadButtonOnClickAction(string $elementId): string
    {
        $mediaBrowserAjaxUrl = $this->getUrl(
            'cms/wysiwyg_images/index',
            ['target_element_id' => $elementId, 'type' => 'file']
        );
        return "MediabrowserUtility.openDialog('$mediaBrowserAjaxUrl')";
    }

    public function getVideoUrl(): string
    {
        if ($this->element->getData('value')) {
            return $this->getMediaUrl() . DIRECTORY_SEPARATOR . $this->element->getValue();
        }
        return "";
    }

    public function getMediaUrl(): string
    {
        return $this->_storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

}