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

namespace Smsto\Sms\Model\Data;

use Smsto\Sms\Api\Data\SmslogInterface;

class Smslog extends \Magento\Framework\Api\AbstractExtensibleObject implements SmslogInterface
{

    /**
     * Get log_id
     * @return string|null
     */
    public function getlogId()
    {
        return $this->_get(self::LOG_ID);
    }

    /**
     * Set log_id
     * @param string $logId
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setlogId($logId)
    {
        return $this->setData(self::LOG_ID, $logId);
    }


    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Smsto\Sms\Api\Data\SmslogExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Smsto\Sms\Api\Data\SmslogExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Smsto\Sms\Api\Data\SmslogExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get msg_date
     * @return string|null
     */
    public function getMsgDate()
    {
        return $this->_get(self::MSG_DATE);
    }

    /**
     * Set msg_date
     * @param string $msgDate
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setMsgDate($msgDate)
    {
        return $this->setData(self::MSG_DATE, $msgDate);
    }

    /**
     * Get origin
     * @return string|null
     */
    public function getOrigin()
    {
        return $this->_get(self::ORIGIN);
    }

    /**
     * Set origin
     * @param string $origin
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setOrigin($origin)
    {
        return $this->setData(self::ORIGIN, $origin);
    }

    /**
     * Get destination
     * @return string|null
     */
    public function getDestination()
    {
        return $this->_get(self::DESTINATION);
    }

    /**
     * Set destination
     * @param string $destination
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setDestination($destination)
    {
        return $this->setData(self::DESTINATION, $destination);
    }

    /**
     * Get message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_get(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get msg_id
     * @return string|null
     */
    public function getMsgId()
    {
        return $this->_get(self::MSG_ID);
    }

    /**
     * Set msg_id
     * @param string $msgId
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setMsgId($msgId)
    {
        return $this->setData(self::MSG_ID, $msgId);
    }

    /**
     * Get Trigger
     * @return string|null
     */
    public function getTrigger()
    {
        return $this->_get(self::TRIGGER);
    }

    /**
     * Set Trigger
     * @param string $trigger
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     */
    public function setTrigger($trigger)
    {
        return $this->setData(self::TRIGGER, $trigger);
    }
}
