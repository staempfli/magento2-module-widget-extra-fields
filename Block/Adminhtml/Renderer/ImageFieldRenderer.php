<?php
/**
 * ImageFieldRenderer
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as FormElementFactory;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface as FormElementRenderer;
use Magento\Framework\UrlInterface;

class ImageFieldRenderer extends Template implements FormElementRenderer
{
    /**
     * @var AbstractElement
     */
    private $element;

    /**
     * @var string
     */
    protected $_template = 'Staempfli_WidgetExtraFields::renderer/image-field-renderer.phtml';
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

    public function getLabel(): string
    {
        return $this->element->getLabel()??'no-label';
    }

    public function getRequiredClass(): string
    {
        return ($this->element->getRequired()) ? ' required _required' : '';;
    }

    public function imagePathInputId(): string
    {
        return 'image-path-' . $this->element->getId();
    }

    public function getImagePreviewDivId(): string
    {
        return 'image-preview-' . $this->element->getId();
    }

    public function getUploadButtonHtml(): string
    {
        $sourceUrl = $this->getUrl(
            'cms/wysiwyg_images/index',
            ['target_element_id' => $this->imagePathInputId(), 'type' => 'file']
        );
        $uploadButton = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setType('button')
            ->setClass('btn-chooser')
            ->setLabel('Upload')
            ->setOnClick('MediabrowserUtility.openDialog("'. $sourceUrl .'")');
        return $uploadButton->toHtml();
    }

    public function getImagePathFieldHtml(): string
    {
        $imagePathField = $this->formElementFactory->create("hidden", ['data' => $this->element->getData()]);
        $imagePathField->setId($this->imagePathInputId());
        $imagePathField->setForm($this->element->getForm());
        if ($this->element->getRequired()) {
            $imagePathField->addClass('required-entry');
        }
        return $imagePathField->getElementHtml();
    }

    public function getImageUrl(): string
    {
        if ($this->element->getData('value')) {
            return $this->getMediaUrl() . DIRECTORY_SEPARATOR . $this->element->getData('value');
        }
        return "";
    }

    public function getMediaUrl(): string
    {
        return $this->_storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

}