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
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function callSmsto();

    /**
     * Save Smslog
     * @param \Smsto\Sms\Api\Data\SmslogInterface $smslog
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Smsto\Sms\Api\Data\SmslogInterface $smslog
    );

    /**
     * Retrieve Smslog
     * @param string $logId
     * @return \Smsto\Sms\Api\Data\SmslogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($logId);

    /**
     * Retrieve Smslog matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Smsto\Sms\Api\Data\SmslogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Smslog
     * @param \Smsto\Sms\Api\Data\SmslogInterface $smslog
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Smsto\Sms\Api\Data\SmslogInterface $smslog
    );

    /**
     * Delete Smslog by ID
     * @param string $logId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($logId);
}
