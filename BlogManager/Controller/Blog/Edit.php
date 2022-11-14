<?php
namespace Webkul\BlogManager\Controller\Blog;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Webkul\BlogManager\Helper\CustomerIdData;

//use Magento\Customer\Model\Session;

class Edit extends AbstractAccount
{
    public $resultPageFactory;
//    public $customerSession;
    public $helper;
    public $blogFactory;
    public $messageManager;

    public function __construct(Context $context,
                                PageFactory $resultPageFactory,
//                                Session $customerSession,
                                \Webkul\BlogManager\Helper\CustomerIdData $helper,
                                \Webkul\BlogManager\Model\BlogFactory $blogFactory,
                                \Magento\Framework\Message\ManagerInterface $messageManager)
    {
        $this->resultPageFactory = $resultPageFactory;
//        $this->customerSession = $customerSession;
        $this->helper = $helper;
        $this->messageManager = $messageManager;
        $this->blogFactory = $blogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $customerId = $this->helper->getCustomerId();
        $isAuthorized = $this->blogFactory->create()
                                            ->getCollection()
                                            ->addFieldToFilter('user_id', $customerId)
                                            ->addFieldToFilter('entity_id', $blogId)
                                            ->getSize();
        if(!$isAuthorized)
        {
            $this->messageManager->addError(__('You cannot edit this blog!!'));
            return $this->resultRedirectFactory->create()->setPath('blogmanager/blog');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__("Edit Blog"));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}
