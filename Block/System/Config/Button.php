<?php

namespace Smsto\Sms\Block\System\Config;

/**
 * Button field
 */
class Button extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_template = 'Smsto_Sms::system/config/button.phtml';

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return void
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return void
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }

    /**
     * @return void
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('sms/index/index');
    }

    /**
     * @return void
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            [
                'id' => 'testsms_btn',
                'label' => __('Send SMS'),
            ]
        );

        return $button->toHtml();
    }
}
