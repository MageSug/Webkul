<?php
namespace Webkul\BlogManager\Block;

use Magento\Framework\View\ELement\Template;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template\Context;

class BlogList extends Template
{
    public $blogCollection;

    public function __construct(Context $context, 
        Session $customerSession, \Webkul\BlogManager\Model\ResourceModel\Blog\CollectionFactory $blogCollection, 
        array $data = [])
    {
        $this->blogCollection = $blogCollection;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getBlogs()
    {
        $collection = $this->blogCollection->create();
        $customer = $this->customerSession->getCustomer();
        $customerId = $customer->getId();
        // $collection->addFieldToFilter('user_id', ['eq'=>$customerId]);
        $collection->setOrder('updated_at', 'DESC');
        return $collection;
    }
}