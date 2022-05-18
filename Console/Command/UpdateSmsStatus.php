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

namespace Smsto\Sms\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Smsto\Sms\Logger\Logger as Logger;

class UpdateSmsStatus extends Command
{

    protected $logger;
    protected $smslogFactory;
    protected $smsHelper;


    /**
     * Constructor
     *
     * @param Logger $logger
     * @param \Smsto\Sms\Model\ResourceModel\Smslog\CollectionFactory $smslogFactory
     * @param \Smsto\Sms\Helper\Sms $smsHelper
     */
    public function __construct(\Smsto\Sms\Helper\Sms $smsHelper, Logger $logger, \Smsto\Sms\Model\ResourceModel\Smslog\CollectionFactory $smslogFactory)
    {
        $this->logger = $logger;
        $this->smslogFactory = $smslogFactory;
        $this->smsHelper = $smsHelper;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $this->logger->info('Smsto Cron Initiated', []);
        $smslogObj = $this->smslogFactory->create();
        $smslogCollection = $smslogObj->addFieldToFilter('status', array('eq' => 'Pending', 'eq' => 'Processing'));
        foreach ($smslogCollection as $smslog) {
            $messageId = $smslog->getMsgId();
            $status = $this->smsHelper->getSmsStatus($messageId);
            $this->logger->info('Smsto Cron Initiated', [$status]);
            if ($status) {
                $smslog->setStatus($status);
                $smslog->save();
            }

        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("smsto_sms:updatesmsstatus");
        $this->setDescription("Cron Schduler to update sms status");
        parent::configure();
    }
}
