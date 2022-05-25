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

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Smsto\Sms\Api\SmslogRepositoryInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Smsto\Sms\Model\ResourceModel\Smslog\CollectionFactory as SmslogCollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Smsto\Sms\Api\Data\SmslogInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Smsto\Sms\Model\ResourceModel\Smslog as ResourceSmslog;

class SmslogRepository implements SmslogRepositoryInterface
{

    protected $resource;

    protected $dataSmslogFactory;

    protected $smslogCollectionFactory;

    protected $smslogFactory;

    protected $dataObjectHelper;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var \Smsto\Sms\Helper\Sms
     */
    protected $smsHelper;

    /**
     * @param ResourceSmslog $resource
     * @param SmslogFactory $smslogFactory
     * @param SmslogInterfaceFactory $dataSmslogFactory
     * @param SmslogCollectionFactory $smslogCollectionFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        ResourceSmslog $resource,
        SmslogFactory $smslogFactory,
        SmslogInterfaceFactory $dataSmslogFactory,
        SmslogCollectionFactory $smslogCollectionFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->smslogFactory = $smslogFactory;
        $this->smslogCollectionFactory = $smslogCollectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSmslogFactory = $dataSmslogFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: ObjectManager::getInstance()
                                                                          ->get(\Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface::class);
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->smsHelper = ObjectManager::getInstance()->get(\Smsto\Sms\Helper\Sms::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getParams() {
        $response = [
            "success" => true,
            "message" => null,
            "messages" => null,
            "data" => [
                "show_reports" => $this->smsHelper->getShowReports(),
                "show_people" => $this->smsHelper->getShowContacts()
            ]
        ];
        echo json_encode($response);
        die;
    }

    /**
     * {@inheritdoc}
     */
    public function callSmsto() {
        $method = strtoupper($_GET['_method']);
        $url = $_GET['_url'];
        $payload = isset($_GET['payload']) ? $_GET['payload'] : null;
        $response = $this->smsHelper->sendRequest($method, $url, $payload);
        echo $response;
        die;
    }

}
