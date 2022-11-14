<?php
namespace Webkul\BlogManager\Controller\Blog;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Delete extends AbstractAccount
{
    public $resultPageFactory;
//    public $customerSession;
    public $blogFactory;
    public $helper;
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
        $this->messageManager = $messageManager;
        $this->helper = $helper;
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
        if(!$isAuthorized){
            $this->messageManager->addError(__('Not authorized to delete this blog!!'));
            return $this->resultRedirectFactory->create()->setPath("blogmanager/blog");
        }
        else{
            $model = $this->blogFactory->create()->load($blogId);
            $model->delete();
            $this->messageManager->addSuccess(__('Deleted successfully'));
        }
        return $this->resultRedirectFactory->create()->setPath("blogmanager/blog");
    }
}
