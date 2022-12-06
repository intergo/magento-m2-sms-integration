<?php

namespace Smsto\Sms\Block\System\Config;

/**
 * Balance field
 */
class Balance extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $_template = 'Smsto_Sms::system/config/balance.phtml';

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $smsHelper;

    /**
     * Undocumented function
     *
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
    public function getButtonHtml()
    {
        return $this->smsHelper->getBalance();
    }
}
