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
 * Undocumented class
 */
class OrderSaveAfter implements \Magento\Framework\Event\ObserverInterface
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
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $destination = null;
        $flag = false;
        $order = $observer->getEvent()->getOrder()->getData();
        $orderId = $order['increment_id'];
        $state = $order['state'];
        $this->logger->info('Order ID (state) & Order:', [$orderId, $state, $order]);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $orderObj = $objectManager->get(\Magento\Sales\Model\Order::class);
        $orderInformation = $orderObj->loadByIncrementId($orderId);

        $address = $orderInformation->getShippingAddress() ?? $orderInformation->getBillingAddress();

        if (($address instanceof \Magento\Sales\Model\Order\Address)) {
            $destination = $address->getTelephone();
        } else {

            if (isset($order['addresses']) === false) {
                $this->logger->info("Billing/Shipping address not found");

                return;
            }

            foreach ($order['addresses'] as $addr) {
                if ($addr['telephone'] !== null) {
                    $destination = $addr['telephone'];
                }
            }
        }

        if ($destination) {
            $this->logger->info('Customer Mobile:', [$destination]);
            if ($state == "new" && $this->smsHelper->getNewOrderSmsEnabled()) {
                $this->logger->info('New order SMS Initiated', [$order]);
                $trigger = "New Order";
                $origin = $this->smsHelper->getNewOrderSmsSenderId();
                $message = $this->smsHelper->getNewOrderSmsText();
                $adminNotify = $this->smsHelper->getNewOrderSmsAdminNotifyEnabled();
                $flag = true;
            }

            if ($state == "holded" && $this->smsHelper->getOrderHoldSmsEnabled()) {
                $this->logger->info('hold order SMS Initiated', [$order]);
                $trigger = "Hold Order";
                $origin = $this->smsHelper->getOrderHoldSmsSenderId();
                $message = $this->smsHelper->getOrderHoldSmsText();
                $adminNotify = $this->smsHelper->getOrderHoldSmsAdminNotifyEnabled();
                $flag = true;
            }

            if (
                isset($_SERVER['REQUEST_URI']) && strpos(
                    $_SERVER['REQUEST_URI'],
                    'order/unhold'
                ) !== false && $this->smsHelper->getOrderUnholdSmsEnabled()
            ) {
                $this->logger->info('unhold order SMS Initiated', [$order]);
                $trigger = "Unhold Order";
                $origin = $this->smsHelper->getOrderUnholdSmsSenderId();
                $message = $this->smsHelper->getOrderUnholdSmsText();
                $adminNotify = $this->smsHelper->getOrderUnholdSmsAdminNotifyEnabled();
                $flag = true;
            }

            if ($flag) {
                $data = $this->smsHelper->getOrderData($orderInformation);
                $data['CustomerTelephone'] = $destination;
                $message = $this->smsHelper->messageProcessor($message, $data);
                $this->smsHelper->sendSms($origin, $destination, $message, null, $trigger, $adminNotify);
            }
        } else {
            $this->logger->info('Customer does not have phone number associated to his billing/shipping address.');
        }
    }
}
