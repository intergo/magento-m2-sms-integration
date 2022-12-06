<?php

namespace Smsto\Sms\Block\System\Config;

/**
 * Balance field
 */
class Balance extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_template = 'Smsto_Sms::system/config/balance.phtml';
    protected $smsHelper;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Smsto\Sms\Helper\Sms $smsHelper
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Smsto\Sms\Helper\Sms $smsHelper
    ) {
        $this->smsHelper = $smsHelper;
        parent::__construct($context);
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
    public function getButtonHtml()
    {
        return $this->smsHelper->getBalance();
    }
}
