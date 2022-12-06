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

namespace Smsto\Sms\Controller\Adminhtml\Index;

/**
 * Index action
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     *
     * @var [type]
     */
    protected $resultPageFactory;

    /**
     * @var [type]
     */
    protected $jsonHelper;

    /**
     * @var [type]
     */
    protected $smsHelper;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Smsto\Sms\Helper\Sms $smsHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Smsto\Sms\Helper\Sms $smsHelper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonHelper = $jsonHelper;
        $this->smsHelper = $smsHelper;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {

            $destination = $this->smsHelper->getTestMobileNumber() ?? $this->getRequest()->getPost('destination');
            $message = $this->smsHelper->getTestSmsText() ?? $this->getRequest()->getPost('message');
            $origin = $this->smsHelper->getSenderId() ?? $this->getRequest()->getPost('origin') ?? null;

            $output = $this->smsHelper->sendSms($origin, $destination, $message);

            return $this->jsonResponse($output);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param string $response
     * @return void
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }
}
