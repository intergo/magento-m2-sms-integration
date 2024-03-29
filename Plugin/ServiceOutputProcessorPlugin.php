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

namespace Smsto\Sms\Plugin;

use Magento\Framework\Webapi\ServiceOutputProcessor;

/**
 * Undocumented class
 */
class ServiceOutputProcessorPlugin
{
    /**
     * Undocumented function
     *
     * @param ServiceOutputProcessor $subject
     * @param callable $proceed
     * @param [type] $data
     * @param [type] $type
     * @return void
     */
    public function aroundConvertValue(ServiceOutputProcessor $subject, callable $proceed, $data, $type)
    {
        if ($type == 'array') {
            return $data;
        }
        return $proceed($data, $type);
    }
}
