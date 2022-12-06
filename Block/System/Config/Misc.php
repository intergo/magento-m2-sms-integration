<?php

namespace Smsto\Sms\Block\System\Config;

/**
 * Misc field
 */
class Misc extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $_template = 'Smsto_Sms::system/config/misc.phtml';

    /**
     * Undocumented variable
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return void
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Undocumented variable
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return void
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }
}
