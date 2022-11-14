<?php
namespace Webkul\BlogManager\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Add extends Action
{
    public $resultFactory;
    
    public function __construct(Context $context, ResultFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__("New Blog"));
        return $resultPage;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Webkul_BlogManager::add');
    }
}