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

namespace Smsto\Sms\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Smsto\Sms\Logger\Logger as Logger;

/**
 * Sms helper
 */
class Sms extends AbstractHelper
{
    /**
     * @var [type]
     */
    protected $objectInterface;

    /**
     * @var [type]
     */
    protected $objectManager;

    /**
     * @var Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_timezoneInterface;

    /**
     * Undocumented function
     *
     * @param Context $context
     * @param Logger $logger
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface
     */
    public function __construct(
        Context $context,
        Logger $logger,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface
    ) {
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->objectInterface = $this->objectManager->get(\Magento\Framework\App\Config\ScopeConfigInterface::class);
        $this->_timezoneInterface = $timezoneInterface;
        parent::__construct($context);
    }

    /**
     * Returns API Key from Store Configuration
     *
     * @return string
     */
    public function getApiKey()
    {
        return trim($this->objectInterface->getValue('generalsettings/smstosettings/apikey'));
    }

    /**
     * Returns Sender ID from Store Configuration
     *
     * @return string
     */
    public function getSenderId()
    {
        return $this->objectInterface->getValue('generalsettings/smstosettings/senderid');
    }

    /**
     * Returns Store Mobile Number from Store Configuration
     *
     * @return string
     */
    public function getStoreMobileNumber()
    {
        return $this->objectInterface->getValue('generalsettings/smstosettings/storemobile');
    }

    /**
     * Returns Show Reports Configuration
     *
     * @return string
     */
    public function getShowReports()
    {
        return $this->objectInterface->getValue('generalsettings/smstosettings/showreports');
    }

    /**
     * Returns Show Contacts Configuration
     *
     * @return string
     */
    public function getShowContacts()
    {
        return $this->objectInterface->getValue('generalsettings/smstosettings/showcontacts');
    }

    /**
     * Returns Test SMS Text from Store Configuration
     *
     * @return string
     */
    public function getTestSmsText()
    {
        return $this->objectInterface->getValue('generalsettings/testsmssettings/testsmstext');
    }

    /**
     * Returns Test Mobile Number from Store Configuration
     *
     * @return string
     */
    public function getTestMobileNumber()
    {
        return $this->objectInterface->getValue('generalsettings/testsmssettings/testmobilenumber');
    }

    /**
     * Returns whether new order sms is enabled or not
     *
     * @return boolean
     */
    public function getNewOrderSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/neworder/enabled');
    }

    /**
     * Returns New Order SMS Text from Store Configuration
     *
     * @return string
     */
    public function getNewOrderSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/neworder/smstext');
    }

    /**
     * Returns whether new order sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getNewOrderSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/neworder/adminnotify');
    }

    /**
     * Returns New Order SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getNewOrderSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/neworder/senderid');
    }

    /**
     * Returns whether order paid  sms is enabled or not
     *
     * @return boolean
     */
    public function getOrderPaidSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/orderpaid/enabled');
    }

    /**
     * Returns order paid  SMS Text from Store Configuration
     *
     * @return string
     */
    public function getOrderPaidSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/orderpaid/smstext');
    }

    /**
     * Returns whether order paid  sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getOrderPaidSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/orderpaid/sendadmin');
    }

    /**
     * Returns order paid  SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getOrderPaidSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/orderpaid/senderid');
    }

    /**
     * Returns whether order refund sms is enabled or not
     *
     * @return boolean
     */
    public function getRefundOrderSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/refundorder/senderid');
    }

    /**
     * Returns order refund SMS Text from Store Configuration
     *
     * @return string
     */
    public function getRefundOrderSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/refundorder/smstext');
    }

    /**
     * Returns whether order refund  sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getRefundOrderSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/refundorder/adminnotify');
    }

    /**
     * Returns order refund SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getRefundOrderSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/refundorder/senderid');
    }

    /**
     * Returns whether order cancel sms is enabled or not
     *
     * @return boolean
     */
    public function getCancelOrderSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/ordercancel/enabled');
    }

    /**
     * Returns order cancel SMS Text from Store Configuration
     *
     * @return string
     */
    public function getCancelOrderSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/ordercancel/smstext');
    }

    /**
     * Returns whether order cancel sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getCancelOrderSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/ordercancel/adminnotify');
    }

    /**
     * Returns order cancel SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getCancelOrderSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/ordercancel/senderid');
    }

    /**
     * Returns whether new shipment sms is enabled or not
     *
     * @return boolean
     */
    public function getNewShipmentSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/newshipment/enabled');
    }

    /**
     * Returns New Shipment SMS Text from Store Configuration
     *
     * @return string
     */
    public function getNewShipmentSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/newshipment/smstext');
    }

    /**
     * Returns whether new shipment sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getNewShipmentSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/newshipment/adminnotify');
    }

    /**
     * Returns New Shipment SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getNewShipmentSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/newshipment/senderid');
    }

    /**
     * Returns whether shipment updates sms is enabled or not
     *
     * @return boolean
     */
    public function getShipmentUpdatesSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/shipmentupdates/enabled');
    }

    /**
     * Returns Shipment Updates SMS Text from Store Configuration
     *
     * @return string
     */
    public function getShipmentUpdatesSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/shipmentupdates/smstext');
    }

    /**
     * Returns whether shipment updates sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getShipmentUpdatesSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/shipmentupdates/adminnotify');
    }

    /**
     * Returns Shipment Updates SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getShipmentUpdatesSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/shipmentupdates/senderid');
    }

    /**
     * Returns whether hold order sms is enabled or not
     *
     * @return boolean
     */
    public function getOrderHoldSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/orderhold/enabled');
    }

    /**
     * Returns hold order sms text from Store Configuration
     *
     * @return string
     */
    public function getOrderHoldSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/orderhold/smstext');
    }

    /**
     * Returns whether hold order sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getOrderHoldSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/orderhold/adminnotify');
    }

    /**
     * Returns hold order SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getOrderHoldSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/orderhold/senderid');
    }

    /**
     * Returns whether unhold order sms is enabled or not
     *
     * @return boolean
     */
    public function getOrderUnholdSmsEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/orderunhold/enabled');
    }

    /**
     * Returns unhold order sms text from Store Configuration
     *
     * @return string
     */
    public function getOrderUnholdSmsText()
    {
        return $this->objectInterface->getValue('smstriggers/orderunhold/smstext');
    }

    /**
     * Returns whether unhold order sms notification to admin is enabled or not
     *
     * @return boolean
     */
    public function getOrderUnholdSmsAdminNotifyEnabled()
    {
        return $this->objectInterface->getValue('smstriggers/orderunhold/adminnotify');
    }

    /**
     * Returns unhold order SMS Sender Id from Store Configuration
     *
     * @return string
     */
    public function getOrderUnholdSmsSenderId()
    {
        return $this->objectInterface->getValue('smstriggers/orderunhold/senderid');
    }

    /**
     * Send SMS function
     *
     * @param string $sender_id
     * @param string $destination
     * @param string $message
     * @param string|null $messageDate
     * @param string $trigger
     * @param boolean $adminNotify
     * @return void
     */
    public function sendSms(
        string $sender_id,
        string $destination,
        string $message,
        string $messageDate = null,
        string $trigger = "Message",
        bool $adminNotify = false
    ) {
        if (empty($message)) {
            return;
        }

        $sender_id = $sender_id ? $sender_id : $this->getSenderId();
        $destinationList = explode(",", $destination);

        $recipients = [];
        $recipients = array_merge($recipients, $destinationList);
        if ($adminNotify) {
            $storeNumber = $this->getStoreMobileNumber();
            $storeNumbers = explode(",", $storeNumber);
            $recipients = array_merge($recipients, $storeNumbers);
        }
        $to = count($recipients) > 1 ? $recipients : $recipients[0];

        $data = [
            'sender_id' => $sender_id,
            'to' => $to,
            'message' => $message,
        ];
        if (empty($sender_id)) {
            unset($data['sender_id']);
        }

        if ($messageDate) {
            $data['scheduledDateTime'] = $this->datetimeconv($messageDate);
            $trigger = "Scheduled Message";
        }

        try {
            $output = $this->sendRequest('POST', 'https://api.sms.to/sms/send', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get balance function
     *
     * @return void
     */
    public function getBalance()
    {
        try {
            $output = $this->sendRequest('GET', 'https://auth.sms.to/api/balance');
        } catch (\Exception $e) {
            return "<strong><p style='color:#ff0000'>" . $e->getMessage() . "</p></strong>";
        }

        $result = json_decode($output);

        if ($result) {

            if (property_exists($result, 'currency') && property_exists($result, 'balance')) {
                return "<strong>" . $result->currency . " " . $result->balance . "</strong>";
            } else {
                return "N/A";
            }
        }
    }

    /**
     * Get sms status
     *
     * @param string $messageId
     * @return void
     */
    public function getSmsStatus(string $messageId)
    {
        $apikey = $this->getApiKey();

        if ($apikey == '' && $secret == '') {
            return 'No API/Secret key Provided';
        }

        try {
            $output = $this->sendRequest("GET", '/v2/sms/' . $messageId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $result = json_decode($output);

        return $result->status;
    }

    /**
     * Undocumented function
     *
     * @param string|null $message
     * @param array $data
     * @return string
     */
    public function messageProcessor(string $message = null, array $data)
    {
        if ($message !== null) {
            foreach ($data as $key => $value) {
                if ($value !== null) {
                    $message = str_replace('{' . $key . '}', $value, $message);
                }
            }
        }

        return $message;
    }

    /**
     * Get order data
     *
     * @param \Magento\Sales\Model\Order $order
     * @return array
     */
    public function getOrderData(\Magento\Sales\Model\Order $order)
    {
        $data = [];
        $data['OrderNumber'] = $order->getIncrementId();
        $data['CustomerFirstName'] = $order->getCustomerFirstname();
        $data['CustomerLastName'] = $order->getCustomerLastname();
        $data['OrderTotal'] = number_format($order->getGrandTotal(), 2);
        $data['CustomerEmail'] = $order->getCustomerEmail();
        $data['OrderCurrency'] = $order->getOrderCurrencyCode();
        $data['OrderDate'] = date('F j, Y', strtotime($order->getCreatedAt()));
        $data['OrderTime'] = date('g:i a', strtotime($order->getCreatedAt()));
        $data['OrderStatus'] = $order->getStatus();

        return $data;
    }

    /**
     * Get shipment data
     *
     * @param \Magento\Sales\Model\Order $order
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @return void
     */
    public function getShipmentData(\Magento\Sales\Model\Order $order, \Magento\Sales\Model\Order\Shipment $shipment)
    {
        $data = [];

        $tracksCollection = $shipment->getTracksCollection();

        foreach ($tracksCollection->getItems() as $track) {

            $data['TrackingNumber'] = $track->getTrackNumber();
            $data['Carrier'] = $track->getCarrierCode();
        }

        return $data;
    }

    /**
     * Undocumented function
     *
     * @param \Magento\Sales\Model\Order $order
     * @return void
     */
    public function getInvoiceData(\Magento\Sales\Model\Order $order)
    {
        $data = [];
        $data['PaymentMode'] = $order->getPayment()->getMethodInstance()->getCode();

        return $data;
    }

    /**
     * Undocumented function
     *
     * @param [type] $customer
     * @return void
     */
    public function getCustomerData($customer)
    {
        $data = [];
        $data['CustomerFirstName'] = $customer->getFirstname();
        $data['CustomerMiddleName'] = $customer->getMiddlename(); // Middle Name
        $data['CustomerLastName'] = $customer->getLastname(); // Middle Name
        $data['CustomerEmail'] = $customer->getEmail();

        return $data;
    }

    /**
     * Undocumented function
     *
     * @param [type] $datetime
     * @return void
     */
    public function datetimeconv($datetime)
    {
        $datetime = new \DateTime(str_replace('T', ' ', substr($datetime, 0, -5)));
        $to = ['localeFormat' => "Y-m-d H:i:s", 'olsonZone' => 'UTC'];

        return $datetime->format($to['localeFormat']);
    }

    /**
     * Undocumented function
     *
     * @param [type] $dateTime
     * @return void
     */
    public function getTimeAccordingToTimeZone($dateTime)
    {
        // for get current time according to time zone
        $today = $this->_timezoneInterface->date()->format('m/d/y H:i:s');

        // for convert date time according to magento time zone
        $dateTimeAsTimeZone = $this->_timezoneInterface->date(new \DateTime($dateTime))->format('m/d/y H:i:s');

        return $dateTimeAsTimeZone;
    }

    /**
     * Undocumented function
     *
     * @param string $method
     * @param string $url
     * @param array|string|null $data
     * @return void
     */
    public function sendRequest(string $method, string $url, array|string $data = null)
    {
        $apikey = $this->getApiKey();
        $method = strtoupper($method);

        if ($method == 'GET' && $data) {
            $params = http_build_query(json_decode($data));
            if ($params) {
                $url = $url . '?' . $params;
            }
        }

        if ($apikey == '') {
            throw new \RuntimeException('No API/Secret key Provided');
        }

        $productMetadata = $this->objectManager->get(\Magento\Framework\App\ProductMetadataInterface::class);
        $agent = "SMSto-Integrations/1.0, Magento-m2/" . $productMetadata->getVersion();

        $curl = curl_init();
        $curlParams = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apikey",
                'Content-Type: application/json',
                'Accept: application/json',
                'X-Smsto-Integration-Name: magento',
            ],
            CURLOPT_USERAGENT => $agent,
        ];

        if ($method != 'GET') {
            $curlParams[CURLOPT_CUSTOMREQUEST] = $method;
            $curlParams[CURLOPT_POSTFIELDS] = is_array($data) ? json_encode($data) : $data;
        }

        curl_setopt_array($curl, $curlParams);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
            throw new \RuntimeException('Retry again.');
        }

        return $response;
    }

    /**
     * Retrieve Client Params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_getRequest()->getParams();
    }
}
