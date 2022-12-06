<?php

namespace Smsto\Sms\Block\System\Config;

/**
 * Button field
 */
class Button extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $_template = 'Smsto_Sms::system/config/button.phtml';

    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return void
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('sms/index/index');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Button::class
        )->setData(
            [
                'id' => 'testsms_btn',
                'label' => __('Send SMS'),
            ]
        );

        return $button->toHtml();
    }
}
