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

namespace Smsto\Sms\Api\Data;

interface SmslogSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Smslog list.
     * @return \Smsto\Sms\Api\Data\SmslogInterface[]
     */
    public function getItems();

    /**
     * Set log_id list.
     * @param \Smsto\Sms\Api\Data\SmslogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
