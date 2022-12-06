<?php

namespace Smsto\Sms\Block\Adminhtml\BulkSend;

/**
 * Bulk sending template
 */
class Index extends \Magento\Backend\Block\Template
{
    /**
     * @var $request
     */
    protected $request;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;


    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        $this->request = $context->getRequest();
        $this->urlBuilder = $context->getUrlBuilder();
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    public function getFormUrl()
    {
        return $this->urlBuilder->getUrl('smsto_sms/smslog/sendSMS');
    }

    /**
     * @return void
     */
    public function getFormKey()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $key_form = $objectManager->get('Magento\Framework\Data\Form\FormKey');
        return $key_form->getFormKey();
    }

    /**
     * @return void
     */
    public function getCustomerParams()
    {
        $data = [];
        $postData = $this->request->getParam('id');

        foreach ($postData as $id) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $customerFactory = $objectManager->get('\Magento\Customer\Model\CustomerFactory');
            $customer = $customerFactory->create();
            $cust = $customer->load($id);
            $data[$id]['name'] = $cust->getName();
            $data[$id]['phone'] = $cust->getDefaultBillingAddress() ? $cust->getDefaultBillingAddress()->getTelephone() : ($cust->getDefaultShippingAddress() ? $cust->getDefaultShippingAddress()->getTelephone() : null);
        }
        return $data;
    }
}
