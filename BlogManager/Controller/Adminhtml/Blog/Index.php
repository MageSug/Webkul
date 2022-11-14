<?php
namespace Webkul\BlogManager\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public $resultPageFactory;
    
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu("Webkul_BlogManager::blog");
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Blog'));
        return $resultPage;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed("Webkul_BlogManager::blog");
    }
}