<?php

/**
 * SMSto SMS Integration with Magento developed by SMSto Team (Panayiotis Halouvas)
 * Copyright (C) 2018  SMSto
 *
 * This file included in Smsto/Sms is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Smsto\Sms\Observer\Sales;

use Smsto\Sms\Logger\Logger as Logger;

/**
 * Notifications order cancel
 */
class OrderCancelAfter implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $smsHelper;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $logger;

    /**
     * Undocumented function
     *
     * @param \Smsto\Sms\Helper\Sms $smsHelper
     * @param Logger $logger
     */
    public function __construct(
        \Smsto\Sms\Helper\Sms $smsHelper,
        Logger $logger
    ) {
        $this->smsHelper = $smsHelper;
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        if ($this->smsHelper->getCancelOrderSmsEnabled()) {

            $orderObject = $observer->getEvent()->getOrder()->getData();
            $this->logger->info('Order data', $orderObject);

            $orderId = $orderObject['entity_id'];
            $this->logger->info('Order Cancel SMS Initiated', [$orderId]);

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $order = $objectManager->create(\Magento\Sales\Model\Order::class)->load($orderId);

            $address = $order->getShippingAddress() ?? $order->getBillingAddress();

            if (($address instanceof \Magento\Sales\Model\Order\Address) === false) {
                $this->logger->info("Billing/Shipping address not found");

                return;
            }

            $destination = $address->getTelephone();
            $this->logger->info('Customer Mobile:', [$destination]);

            if ($destination) {
                $origin = $this->smsHelper->getCancelOrderSmsSenderId();
                $message = $this->smsHelper->getCancelOrderSmsText();
                $adminNotify = $this->smsHelper->getCancelOrderSmsAdminNotifyEnabled();
                $trigger = "Order Canceled";
                $data = $this->smsHelper->getOrderData($order);
                $data['CustomerTelephone'] = $destination;
                $message = $this->smsHelper->messageProcessor($message, $data);
                $this->smsHelper->sendSms($origin, $destination, $message, null, $trigger, $adminNotify);
            }
        }
    }
}
