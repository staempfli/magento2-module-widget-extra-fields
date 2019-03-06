<?php
/**
 * VideoField
 *
 * @copyright Copyright © 2019 Staempfli AG. All rights reserved.
 * @author    florian.auderset@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Staempfli\WidgetExtraFields\Block\Adminhtml\Renderer\VideoFieldRenderer;

class VideoField extends Template
{
    public function prepareElementHtml(AbstractElement $element)
    {
        $fieldRenderer = $this->getLayout()->createBlock(VideoFieldRenderer::class);
        $element->setRenderer($fieldRenderer);
    }
}