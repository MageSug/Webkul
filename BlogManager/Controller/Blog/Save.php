<?php
namespace Webkul\BlogManager\Controller\Blog;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Controller\AbstractAccount;
use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface;

class Save extends AbstractAccount
{
    public $blogFactory;
    public $customerSession;
    public $messageManager;

    public function __construct(Context $context,
                \Webkul\BlogManager\Model\BlogFactory $blogFactory,
                Session $customerSession,
                \Webkul\BlogManager\Helper\CustomerIdData $helper,
                ManagerInterface $messageManager)
    {
        $this->blogFactory = $blogFactory;
        $this->helper = $helper;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $customerId = $this->helper->getCustomerId();
        if(isset($data['id']) && $data['id']){
            $model = $this->blogFactory->create()->load($data['id']);
            $model->setTitle($data['title'])
                    ->setContent($data['content'])
                        ->save();
            $this->messageManager->addSuccess(__('Blog Edited Successfully'));
        }
        else{
            $model = $this->blogFactory->create();
            $model->setTitle($data['title']);
            $model->setContent($data['content']);

            $customer = $this->customerSession->getCustomer();
            $customerId = $customer->getId();

            $model->setUserId($customerId);
            $model->save();

            $this->messageManager->addSuccess(__('Blog Saved'));
        }

        return $this->resultRedirectFactory->create()->setPath('blogmanager/blog');
    }
}
