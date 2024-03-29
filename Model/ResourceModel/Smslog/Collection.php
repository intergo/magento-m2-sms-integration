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

namespace Smsto\Sms\Model\ResourceModel\Smslog;

/**
 * Abstract collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'log_id';

    /**
     * @inheritdoc
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('trigger', 'main_table.trigger');
        parent::_initSelect();
        return $this;
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Smsto\Sms\Model\Smslog::class,
            \Smsto\Sms\Model\ResourceModel\Smslog::class
        );
    }
}
