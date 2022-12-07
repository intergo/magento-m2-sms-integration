<?php

namespace Smsto\Sms\Controller\Adminhtml\Smslog;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Controller\Adminhtml\Index\AbstractMassAction;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;

/**
 * Bulk send mass action
 */
class BulkSend extends AbstractMassAction
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var [type]
     */
    protected $customerRepository;

    /**
     * Undocumented function
     *
     * @param AbstractCollection $collection
     * @return void
     */
    protected function massAction(AbstractCollection $collection)
    {
        $data = [];
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        foreach ($collection as $customer) {
            $data['id'][] = $customer->getId();
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('sms/bulksend', ['_query' => $data]);
    }

    /**
     * Undocumented function
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CustomerRepositoryInterface $customerRepository
    ) {
        parent::__construct($context, $filter, $collectionFactory);
        $this->customerRepository = $customerRepository;
    }
}
