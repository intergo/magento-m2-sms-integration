<?php

namespace Smsto\Sms\Controller\Adminhtml\Smslog;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Smsto\Sms\Model\ResourceModel\Smslog\CollectionFactory as CollectionFactory;
use Smsto\Sms\Logger\Logger as Logger;

/**
 * Send sms action
 */
class SendSms extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var [type]
     */
    protected $smsHelper;

    /**
     * @var [type]
     */
    protected $logger;

    /**
     * Undocumented function
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param \Smsto\Sms\Helper\Sms $smsHelper
     * @param Logger $logger
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Smsto\Sms\Helper\Sms $smsHelper,
        Logger $logger
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->smsHelper = $smsHelper;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {

        $post = $this->getRequest()->getPostValue();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $custObj = $post['entity_id'];
        if (strstr($custObj, ",")) {
            $custids = explode(",", $custObj);
        } else {
            $custids = [$custObj];
        }
        foreach ($custids as $custid) {
            $customer = $objectManager->create(\Magento\Customer\Model\Customer::class)->load($custid);
            $destination = $customer->getDefaultBillingAddress() ?
                $customer->getDefaultBillingAddress()->getTelephone() : ($customer->getDefaultShippingAddress() ?
                    $customer->getDefaultShippingAddress()->getTelephone() :
                    null);
            if ($destination) {
                $data = $this->smsHelper->getCustomerData($customer);
                $this->logger->info('Customer Message SMS Initiated', [$customer->getFirstName()]);
                $trigger = "Customer Message";
                $origin = $post['senderid'];
                $message = $post['message'];
                $message = $this->smsHelper->messageProcessor($message, $data);
                $adminNotify = $post['adminnotify'];
                $this->smsHelper->sendSms($origin, $destination, $message, null, $trigger, $adminNotify);
                $this->messageManager->addSuccess(__('Message Sent'));
            } else {
                $this->messageManager->addError(__('Billing Telephone not found'));
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('customer/index/');
    }
}
