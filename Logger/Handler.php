<?php

namespace Smsto\Sms\Logger;

use Monolog\Logger as  MonoLogger;

/**
 * Base handler
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
