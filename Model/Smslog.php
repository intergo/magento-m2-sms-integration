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

namespace Smsto\Sms\Model;

use Smsto\Sms\Api\Data\SmslogInterface;
use Smsto\Sms\Api\Data\SmslogInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Smslog model
 */
class Smslog extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'smsto_sms_smslog';

    /**
     * @var [type]
     */
    protected $dataObjectHelper;

    /**
     * @var [type]
     */
    protected $smslogDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param SmslogInterfaceFactory $smslogDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Smsto\Sms\Model\ResourceModel\Smslog $resource
     * @param \Smsto\Sms\Model\ResourceModel\Smslog\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SmslogInterfaceFactory $smslogDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Smsto\Sms\Model\ResourceModel\Smslog $resource,
        \Smsto\Sms\Model\ResourceModel\Smslog\Collection $resourceCollection,
        array $data = []
    ) {
        $this->smslogDataFactory = $smslogDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve smslog model with smslog data
     *
     * @return SmslogInterface
     */
    public function getDataModel()
    {
        $smslogData = $this->getData();

        $smslogDataObject = $this->smslogDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $smslogDataObject,
            $smslogData,
            SmslogInterface::class
        );

        return $smslogDataObject;
    }
}
