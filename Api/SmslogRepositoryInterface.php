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

namespace Smsto\Sms\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SmslogRepositoryInterface
{
    /**
     * Retrieve smsto params.
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getParams();

    /**
     * Call smsto api and return result.
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function callSmsto();

}
