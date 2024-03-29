<?php

namespace Smsto\Sms\Logger;

use Monolog\Logger as  MonoLogger;

/**
 * Logging operations
 */
class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     *
     * @var int
     */
    protected $loggerType = MonoLogger::INFO;

    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/sms.log';
}
