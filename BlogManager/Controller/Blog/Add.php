<?php
namespace Webkul\BlogManager\Controller\Blog;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends AbstractAccount
{
    public function __construct(Context $context, PageFactory $resultPageFactory) 
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Add Blog'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}