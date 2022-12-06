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
class OrderShipmentSaveAfter implements \Magento\Framework\Event\ObserverInterface
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
        if ($this->smsHelper->getNewShipmentSmsEnabled()) {
            $shipment = $observer->getEvent()->getShipment()->getData();
            $this->logger->info('Shipment', [$shipment]);
            $orderId = $shipment['order_id'];
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $order = $objectManager->create('Magento\Sales\Model\Order')->load($orderId);

            $address = $order->getShippingAddress() ?? $order->getBillingAddress();

            if (($address instanceof \Magento\Sales\Model\Order\Address) === false) {
                $this->logger->info("Billing/Shipping address not found");

                return;
            }

            $destination = $address->getTelephone();

            $this->logger->info('Customer Mobile:', [$destination]);

            if ($destination) {
                if ($shipment['created_at'] == $shipment['updated_at']) {
                    $this->logger->info('New Shipment SMS Initiated', [$orderId]);
                    $trigger = "New Shipment";
                    $origin = $this->smsHelper->getNewShipmentSmsSenderId();
                    $message = $this->smsHelper->getNewShipmentSmsText();
                    $adminNotify = $this->smsHelper->getNewShipmentSmsAdminNotifyEnabled();
                } else {
                    $this->logger->info('Update Shipment SMS Initiated', [$orderId]);
                    $trigger = "Shipment Updates";
                    $origin = $this->smsHelper->getShipmentUpdatesSmsSenderId();
                    $message = $this->smsHelper->getShipmentUpdatesSmsText();
                    $adminNotify = $this->smsHelper->getShipmentUpdatesSmsAdminNotifyEnabled();
                }
                $data = $this->smsHelper->getOrderData($order);
                $data = array_merge($data, $this->smsHelper->getShipmentData($order, $observer->getEvent()->getShipment()));
                $data['CustomerTelephone'] = $destination;
                $message = $this->smsHelper->messageProcessor($message, $data);
                $this->smsHelper->sendSms($origin, $destination, $message, null, $trigger, $adminNotify);
            }
        }
    }
}
